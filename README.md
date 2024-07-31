## Session to Storage Task

The project includes functionality for adding data to a session, displaying temporary data, editing and deleting data, and finally submitting data to a database. Additionally, it supports importing and exporting data to and from Excel files.

## Features

-   Add data to session
-   Display temporary data with edit and delete options
-   Submit session data to the database
-   Import data from an Excel file
-   Export data to an Excel file

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/VinayWebGuy/task.git
    ```

2. Navigate to the project directory:

    ```bash
     cd task
    ```

3. Set up the `.env` file:

    ```bash
    cp .env.example .env
    ```

4. Generate an application key:

    ```
    php artisan key:generate
    ```

5. Set up the database:
    - Configure your database settings in the `.env` file
    - Run the migrations:
    ```bash
    php artisan migrate
    ```

## Usage

### Adding Data

1. Navigate to the form to add data:

    ```
    http://localhost:8000
    ```

2. Fill in the form and submit. The data will be stored in the session.

### Display Temporary Data

1. Navigate to the temporary data page to view data stored in the session:

    ```
    http://localhost:8000/temp-data
    ```

2. Edit or delete data as needed.

### Final Submit

1. When you have finished adding data, click the "Final Submit" button on the temporary data page. This will save the data to the database and clear the session.

### Import Data from Excel

1. Navigate to the permanent data page:

    ```
    http://localhost:8000/permanent-data
    ```

2. Use the "Import" form to upload an Excel file. The data will be imported into the database.

### Export Data to Excel

1. On the permanent data page, click the "Download" button to export the data from the database to an Excel file.

## Sample Excel File

You can use the following link to download a sample Excel file for testing the import functionality:
[Sample Excel File](https://docs.google.com/spreadsheets/d/1VH7CeRh3n7ANRkBvYDwvBtYnbVBb6qrY/edit?usp=sharing&ouid=103026195574606598794&rtpof=true&sd=true)

## Routes

-   **Home**: `/`
-   **Temporary Data**: `/temp-data`
-   **Permanent Data**: `/permanent-data`
-   **Submit Form**: `/submit-form` (POST)
-   **Update Form**: `/update-form` (POST)
-   **Delete Data**: `/delete-data/{id}` (POST)
-   **Edit Data**: `/edit-data/{id}`
-   **Final Submit**: `/final-submit` (POST)
-   **Download Excel**: `/download-excel`
-   **Upload Excel**: `/upload-excel` (POST)
