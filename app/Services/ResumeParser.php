<?php

namespace App\Services;

use Smalot\PdfParser\Parser as PdfParser;
use PhpOffice\PhpWord\IOFactory;
use App\Models\JobApplication;

class ResumeParser
{
    /**
     * Parse resume file and extract structured data
     */
    public function parse(string $filePath): array
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $content = '';

        // Extract text based on file type
        if ($extension === 'pdf') {
            $content = $this->extractFromPdf($filePath);
        } elseif (in_array($extension, ['docx', 'doc'])) {
            $content = $this->extractFromDocx($filePath);
        } else {
            throw new \InvalidArgumentException("Unsupported file type: {$extension}");
        }

        // Perform NLP analysis
        return [
            'raw_text' => $content,
            'email' => $this->extractEmail($content),
            'phone' => $this->extractPhone($content),
            'skills' => $this->extractSkills($content),
            'experience_years' => $this->extractExperience($content),
            'education' => $this->extractEducation($content),
            'name' => $this->extractName($content),
        ];
    }

    /**
     * Extract text from PDF
     */
    private function extractFromPdf(string $filePath): string
    {
        try {
            $parser = new PdfParser();
            $pdf = $parser->parseFile($filePath);
            return $pdf->getText();
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Extract text from DOCX
     */
    private function extractFromDocx(string $filePath): string
    {
        try {
            $phpWord = IOFactory::load($filePath);
            $text = '';
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . "\n";
                    }
                }
            }
            return $text;
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Extract email address
     */
    private function extractEmail(string $text): ?string
    {
        preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $text, $matches);
        return $matches[0] ?? null;
    }

    /**
     * Extract phone number
     */
    private function extractPhone(string $text): ?string
    {
        preg_match('/(?:\+?\d{1,3}[-.\s]?)?(?:\(?\d{3}\)?[-.\s]?)?\d{3}[-.\s]?\d{4}/', $text, $matches);
        return $matches[0] ?? null;
    }

    /**
     * Extract skills from predefined list
     */
    private function extractSkills(string $text): array
    {
        $commonSkills = [
            'PHP', 'Laravel', 'JavaScript', 'React', 'Vue', 'Node.js',
            'Python', 'Django', 'Java', 'Spring', 'C#', '.NET',
            'SQL', 'MySQL', 'PostgreSQL', 'MongoDB', 'Redis',
            'AWS', 'Azure', 'Docker', 'Kubernetes', 'CI/CD',
            'Git', 'Agile', 'Scrum', 'REST API', 'GraphQL',
            'HTML', 'CSS', 'Tailwind', 'Bootstrap', 'TypeScript',
            'Communication', 'Leadership', 'Team Management', 'Problem Solving'
        ];

        $foundSkills = [];
        $textLower = strtolower($text);

        foreach ($commonSkills as $skill) {
            if (stripos($textLower, strtolower($skill)) !== false) {
                $foundSkills[] = $skill;
            }
        }

        return array_unique($foundSkills);
    }

    /**
     * Extract years of experience
     */
    private function extractExperience(string $text): int
    {
        preg_match('/(\d+)\+?\s*(?:years?|yrs?)/i', $text, $matches);
        return isset($matches[1]) ? (int)$matches[1] : 0;
    }

    /**
     * Extract education details
     */
    private function extractEducation(string $text): array
    {
        $education = [];
        
        // Look for degree patterns
        $patterns = [
            '/(Bachelor[\'s]?|B\.?S\.?|B\.?A\.?)[\s\w]* in [\w\s]+/i',
            '/(Master[\'s]?|M\.?S\.?|M\.?A\.?|MBA)[\s\w]* in [\w\s]+/i',
            '/(Ph\.?D\.?|Doctorate)[\s\w]* in [\w\s]+/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                $education[] = trim($matches[0]);
            }
        }

        return $education;
    }

    /**
     * Extract candidate name (heuristic)
     */
    private function extractName(string $text): ?string
    {
        // Simple heuristic: first line that looks like a name
        $lines = explode("\n", trim($text));
        foreach ($lines as $line) {
            $line = trim($line);
            if (preg_match('/^[A-Z][a-z]+\s+[A-Z][a-z]+$/', $line)) {
                return $line;
            }
        }
        return null;
    }

    /**
     * Calculate match score against job description
     */
    public function calculateMatchScore(array $parsedData, string $jobDescription): int
    {
        $score = 0;
        $maxScore = 100;

        // Extract required skills from job description
        $jobSkills = $this->extractSkills($jobDescription);
        $candidateSkills = $parsedData['skills'];

        // Skill match (50 points)
        if (!empty($jobSkills)) {
            $matchedSkills = array_intersect($jobSkills, $candidateSkills);
            $skillScore = (count($matchedSkills) / count($jobSkills)) * 50;
            $score += $skillScore;
        }

        // Experience match (30 points)
        preg_match('/(\d+)\+?\s*(?:years?|yrs?)/i', $jobDescription, $expMatches);
        if (isset($expMatches[1])) {
            $requiredExp = (int)$expMatches[1];
            if ($parsedData['experience_years'] >= $requiredExp) {
                $score += 30;
            } else {
                $score += ($parsedData['experience_years'] / $requiredExp) * 30;
            }
        }

        // Education match (20 points)
        if (!empty($parsedData['education'])) {
            $score += 20;
        }

        return min((int)$score, $maxScore);
    }

    /**
     * Process and update job application with parsed data
     */
    public function processApplication(JobApplication $application): void
    {
        $filePath = storage_path('app/' . $application->resume_path);
        
        if (!file_exists($filePath)) {
            return;
        }

        $parsedData = $this->parse($filePath);
        $jobDescription = $application->job->description ?? '';

        $matchScore = $this->calculateMatchScore($parsedData, $jobDescription);

        $application->update([
            'parsed_name' => $parsedData['name'],
            'parsed_email' => $parsedData['email'],
            'parsed_phone' => $parsedData['phone'],
            'parsed_skills' => json_encode($parsedData['skills']),
            'parsed_experience_years' => $parsedData['experience_years'],
            'parsed_education' => json_encode($parsedData['education']),
            'match_score' => $matchScore,
            'auto_reject' => $matchScore < 30, // Auto-reject if score below 30%
        ]);
    }
}
