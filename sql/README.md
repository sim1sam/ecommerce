# Database Setup

This directory contains the database structure for the Laravel ecommerce project.

## Setup Instructions

1. Create a MySQL database named `ecommerce`
2. Import the database structure using the provided SQL file
3. Update the API keys in the database with your own credentials:
   - Stripe keys
   - PayMongo keys  
   - Twilio credentials
   - Other payment gateway credentials

## Security Note

The SQL file contains placeholder values for API keys. Replace these with your actual credentials:

- `YOUR_STRIPE_PUBLIC_KEY` - Your Stripe publishable key
- `YOUR_STRIPE_SECRET_KEY` - Your Stripe secret key
- `YOUR_PAYMONGO_PUBLIC_KEY` - Your PayMongo public key
- `YOUR_PAYMONGO_SECRET_KEY` - Your PayMongo secret key
- `YOUR_TWILIO_ACCOUNT_SID` - Your Twilio Account SID
- `YOUR_TWILIO_AUTH_TOKEN` - Your Twilio Auth Token
- `YOUR_TWILIO_PHONE_NUMBER` - Your Twilio phone number

## Environment Variables

Make sure to set up your `.env` file with the correct database credentials and API keys.
