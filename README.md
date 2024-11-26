# To-Do-list

# To-Do List Application

This project is a simple **To-Do List Application** built with PHP and HTML. It allows users to create, update, and delete tasks while keeping track of task completion status and dates. The tasks are stored in the user's session for simplicity.

## Features

- **User Login Required**: The application checks if a user is logged in (`$_SESSION['username']`).
- **Add Tasks**: Users can create new tasks by providing a name and an optional description.
- **Mark Tasks as Completed**: Tasks can be marked as "completed," and their status will update in the list.
- **Delete Tasks**: Users can remove tasks from the list.
- **Display Task Details**: The application shows the task's unique ID, name, description, status, and creation date.
- **Responsive Design**: The application is designed to adapt to different screen sizes, including mobile devices.

## How It Works

1. **Session Management**:
   - Tasks are stored in the session (`$_SESSION['taches']`), so they persist during the user's session but will reset when the session ends.
   - User authentication is simulated by checking if `$_SESSION['username']` is set. If not, users are redirected to `login.php`.

2. **Task Actions**:
   - **Adding a Task**: Users submit a task name and description via a form. Each task is assigned a unique ID (`uniqid()`), the current date, and a default "not completed" status.
   - **Deleting a Task**: A "Delete" button allows users to remove tasks by their unique ID.
   - **Marking a Task as Completed**: A "Mark as Completed" button changes the task's status.

3. **Display**:
   - Tasks are displayed in a table format.
   - The table dynamically adapts to the tasks stored in the session.
   - Task statuses are visually differentiated by color: **red** for "In Progress" and **green** for "Completed."

4. **Responsive Design**:
   - The application uses CSS to ensure a mobile-friendly interface.
   - Tables are scrollable on smaller screens, and form inputs resize dynamically.

## Requirements

- PHP 7.4 or higher
- A web server (e.g., Apache or Nginx) with PHP support
- Basic knowledge of HTML and CSS for further customization

## Future Improvements

Add persistent storage (e.g., MySQL or SQLite database) instead of session-based storage.
- Implement user authentication with password protection.
- Enhance the UI with a frontend framework like Bootstrap or TailwindCSS.
- Include AJAX for a smoother, more dynamic user experience.
- vbnet
