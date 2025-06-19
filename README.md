# Assignment Submission Portal 

## Description
Assignment Submission Portal  is a web-based application designed to streamline the process of managing assignments for faculty and students. Faculty can create courses, post assignments, review submissions, and give score and feedback,  while students can view courses, submit assignments, and receive notifications.

## Features
- **Faculty Features:**
  - Create and manage courses.
  - Post assignments with descriptions and due dates.
  - Review and grade student submissions.
  

- **Student Features:**
  - View assigned courses and assignments.
  - Submit assignments with file uploads.
  - Receive notifications for assignment score and feedback.

- **Notifications:**
  - In-app notifications, the student will be notify for assignment score and feedback of the instructor.

## Setup Steps

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL database

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/username/AssignmentSubmissionPortalV2.git
   ```
2. Navigate to the project directory:
   ```bash
   cd AssignmentSubmissionPortalV2
   ```
3. Install PHP dependencies:
   ```bash
   composer install
   ```
4. Install JavaScript dependencies:
   ```bash
   npm install
   ```
5. Create a `.env` file by copying `.env.example`:
   ```bash
   cp .env.example .env
   ```
6. Configure the `.env` file with your database credentials.

### Database Setup
1. Run migrations to set up the database schema:
   ```bash
   php artisan migrate
   ```
2. Seed the database with default roles:
   ```bash
   php artisan db:seed
   ```

### Running the Application
1. Start the development server:
   ```bash
   php artisan serve
   ```
2. Open your browser and navigate to:
   ```
   http://127.0.0.1:8000
   ```

## Feature Overview
### Faculty
- **Course Management:** Create, and delete courses.
- **Assignment Management:** Post assignments with descriptions and due dates.
- **Submission Review:** View, grade, and provide feedback on student submissions.

### Student
- **Course Dashboard:** View courses and assignments.
- **Assignment Submission:** Upload files and submit assignments.
- **Notifications:** Receive updates for assignment score and feedback.

### Notifications
- Students receive in-app notifications for assignment score and feedback from faculty.

## License
--

## Contact
For questions or support, contact:
- **Name**: Earl John S. Solicar | Jetro Uy
- **Email**: solicarearljohn@example.com