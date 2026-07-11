# Google Tag Manager Integration Guide

## Overview
This project includes a comprehensive Google Tag Manager (GTM) integration with GDPR/CCPA compliance via Cookiebot Consent Management Platform (CMP).

## Features Implemented

### 1. Configuration
- **Config File**: `config/services.php` - GTM ID and enabled status
- **Environment Variables**: 
  - `GTM_ID` - Your GTM container ID (e.g., GTM-XXXXXX)
  - `GTM_ENABLED` - Enable/disable GTM (default: true)
  - `COOKIEBOT_CONSENT_ID` - Your Cookiebot consent ID

### 2. Compliance Features
- **Cookiebot CMP Integration**: Loads only after user consent for statistics cookies
- **Script Type**: Uses `type="text/plain"` with `data-cookieconsent="statistics"` attribute
- **Noscript Fallback**: Includes iframe fallback for non-JS environments
- **GDPR/CCPA Ready**: Respects user consent preferences

### 3. Performance Optimizations
- **Cookie Trimming**: Automatically trims `_gac_UA` and `_ga_*` cookies to prevent header size issues
  - Keeps maximum 15 cookies per type
  - Preserves most recent cookies
  - Maintains safelist for specific GA properties

### 4. Data Layer Initialization
- Proper `window.dataLayer` initialization
- Compatible with GTM and Google Analytics 4

## Setup Instructions

### Step 1: Configure Environment Variables

Add to your `.env` file:

```env
GTM_ID=GTM-XXXXXX
GTM_ENABLED=true
COOKIEBOT_CONSENT_ID=your-cookiebot-id-here
```

### Step 2: Get Your IDs

1. **GTM ID**: 
   - Go to https://tagmanager.google.com
   - Create a new container or select existing
   - Copy the Container ID (starts with GTM-)

2. **Cookiebot Consent ID**:
   - Go to https://www.cookiebot.com
   - Create an account and register your domain
   - Copy your Consent ID from the dashboard

### Step 3: Clear Config Cache

```bash
php artisan config:clear
php artisan cache:clear
```

## How It Works

### Script Loading Flow

1. **Page Load**: Layout checks for GTM ID in settings
2. **Consent Check**: Cookiebot script loads and shows consent banner
3. **User Consent**: When user accepts "Statistics" cookies:
   - GTM script executes
   - Data layer initializes
   - Tags fire according to GTM configuration
4. **Cookie Management**: Automatic trimming prevents header bloat

## Admin Panel Integration

The GTM ID can also be managed via the admin panel:

1. Go to `/admin/settings`
2. Navigate to **SEO** tab
3. Enter your **Google Tag Manager ID**
4. Save changes

This uses the `Setting` model with key `seo.google_tag_manager_id`.

## Security Considerations

- No hardcoded GTM IDs in codebase
- Environment-based configuration
- Consent-based loading (GDPR compliant)
- No sensitive data in dataLayer by default
- Parameterized cookie operations (no XSS)
