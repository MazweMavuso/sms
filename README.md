# High School Management System API (SMS)

A robust, secure, and modern RESTful API designed specifically for high school administration. Built with Laravel 12, this system provides a unified interface for managing students, teachers, parents, attendance, and academic performance.

---

## 🤖 Development Methodology: The "AI-First" Approach

This project represents a shift in modern software engineering. It was **developed entirely through conscious and aware prompting** using the **Gemini CLI** and autonomous agents.

- **Zero Manual Code Editing:** Every line of code, migration, policy, and architectural decision was executed by an AI agent under strategic direction.
- **Agentic Workflow:** The development followed a rigorous Research -> Strategy -> Execution cycle, ensuring high-quality, idiomatic Laravel code.
- **Skill Evolution:** This project serves as a practical exercise in **Prompt Engineering and Agentic Orchestration**, aimed at staying relevant in the new paradigm of software development and maintenance.

---

## 🚀 Features
... (rest of the content)
- **Advanced Role-Based Access Control (RBAC):**
  - **Admins:** Full system oversight.
  - **Teachers:** Manage attendance, subjects, and students in their classes.
  - **Parents:** Real-time visibility into their children's academic life.
  - **Students:** Access to personal profiles, attendance, and grades.
- **Data Integrity & Security:**
  - Strict authorization policies ensuring parents only see data for their linked children.
  - Teachers are restricted to data within their assigned subjects.
- **Unified API Responses:** Consistent JSON structure for all success and error states, perfect for frontend consumption.
- **Comprehensive Academic Tracking:**
  - Attendance monitoring.
  - Subject and enrollment management.
  - Profile management for all stakeholders.
- **Eswatini Localized:** Pre-configured for Eswatini time zone (Africa/Mbabane).

## 🛠 Tech Stack

- **Framework:** Laravel 12
- **PHP:** 8.2+
- **Database:** MySQL
- **Testing:** Pest PHP
- **Authorization:** Laravel Policies & Gate Facade
- **Standardization:** Laravel Pint

## 📦 Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/MazweMavuso/sms.git
   cd sms
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Start the Server:**
   ```bash
   php artisan serve
   ```

## 🔐 Permission Strategy

The system utilizes a relationship-based authorization model:
- **Family Linking:** Students and Parents are linked via a pivot table.
- **Academic Assignment:** Teachers are assigned to subjects, granting them permission to manage attendance for those specific records.
- **Global Error Handling:** All authorization failures return a clear `403 Forbidden` response with a descriptive message.

## 📡 API Response Format

All responses follow a standard envelope:

**Success Example:**
```json
{
  "success": true,
  "message": "Attendance records retrieved successfully.",
  "data": [ ... ]
}
```

**Error Example (e.g., Validation):**
```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email has already been taken."]
  }
}
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
