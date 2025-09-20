# Beet Tofer Laravel Application

A comprehensive Laravel application for managing branches, devices, transactions, and cashier data with Excel import/export functionality.

## Features

### 1. Database Structure
- **Branches Table**: 10 pre-configured branches (Branch 1 to Branch 10)
- **Devices Table**: Multiple devices per branch with unique device numbers
- **Transactions Table**: Stores transaction data imported from Excel files
- **Cashier Inputs Table**: Stores manual cashier data entry

### 2. Excel Import System
- Import transaction data from Excel/CSV files
- Format: device_number, amount, date
- Automatic device lookup and branch association
- Error handling for invalid device numbers

### 3. Cashier Data Entry
- 15 equal sections with 9 inputs each
- 3 inputs per row with labels
- Dynamic "Add 3 More Inputs" functionality
- Bulk data submission

### 4. Excel Export System
- Generate reports by date
- Export cashier data with all relevant fields
- Excel format with proper headers

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure database in `.env` file

5. Run migrations and seeders:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage

### Accessing the Application
- Home page: `http://localhost:8000`
- Transaction Import: `http://localhost:8000/transaction-import`
- Cashier Data Entry: `http://localhost:8000/cashier-input`
- Export Reports: `http://localhost:8000/cashier-export`

### Excel Import Format
Create an Excel/CSV file with the following columns:
- `device_number`: Device identifier (e.g., DEV1-1, DEV2-3)
- `amount`: Transaction amount (decimal)
- `date`: Transaction date (YYYY-MM-DD format)

### Sample Data
A sample CSV file is provided at `public/sample_transactions.csv` for testing.

### Cashier Data Entry
1. Navigate to the Cashier Data Entry page
2. Fill in data across 15 sections
3. Each section has 9 input fields arranged in 3 rows
4. Use "Add 3 More Inputs" to dynamically add more fields
5. Submit all data at once

### Exporting Reports
1. Go to Export Reports page
2. Select a date
3. Download Excel report with all cashier data for that date

## Database Schema

### Branches
- id (primary key)
- name (string)
- created_at, updated_at

### Devices
- id (primary key)
- branch_id (foreign key → branches.id)
- device_number (string, unique)
- created_at, updated_at

### Transactions
- id (primary key)
- branch_id (foreign key → branches.id)
- device_id (foreign key → devices.id)
- amount (decimal)
- transaction_date (date)
- created_at, updated_at

### Cashier Inputs
- id (primary key)
- cashier_number (string)
- branch_id (foreign key → branches.id)
- cash_value (decimal)
- network_value (decimal)
- created_at, updated_at

## Dependencies

- Laravel 12.x
- Maatwebsite/Laravel-Excel
- Tailwind CSS (via CDN)
- PHP 8.2+

## Testing

The application includes:
- Sample Excel file for import testing
- Pre-seeded data (10 branches, 50 devices)
- Responsive design for all screen sizes

## Support

For any issues or questions, please refer to the Laravel documentation or create an issue in the repository.