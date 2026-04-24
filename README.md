# High School Management System (SMS) API

A professional-grade, secure, and modern RESTful API designed to streamline high school administration. This platform provides a centralized ecosystem for managing the intricate relationships between students, teachers, parents, and academic oversight.

---

## 🤖 The "Agentic" Engineering Paradigm

This project is a showcase of modern software craftsmanship. It was **developed entirely through strategic, conscious prompting** using the **Gemini CLI** and autonomous AI agents.

*   **Autonomous Implementation:** 100% of the codebase, architectural design, and security policies were implemented via AI-driven agentic workflows.
*   **Zero Manual Intervention:** No manual code editing was performed. All logic was directed through expert-level orchestration.
*   **Future-Ready Development:** This repository serves as a practical milestone in mastering **Agentic Orchestration**, demonstrating how to leverage AI to maintain high quality, strict data integrity, and idiomatic standards in the evolving software landscape.

---

## 🚀 Key Features

*   **Secure Access Control (RBAC):** Tiered authorization for Admins, Teachers, Parents, and Students.
*   **Granular Data Integrity:** Advanced Laravel Policies ensure parents access only their children's data and teachers manage only their assigned subjects.
*   **Unified API Response System:** A standardized JSON envelope for all responses, providing consistency for frontend consumers.
*   **Automated Academic Lifecycle:** Comprehensive management of attendance, enrollments, subjects, and school classes.
*   **Built-in Security:** Token-based authentication via Laravel Sanctum and custom role-based middleware.

---

## 🛠 Technical Foundation

*   **Framework:** [Laravel 12](https://laravel.com)
*   **Runtime:** PHP 8.2+
*   **Authentication:** Laravel Sanctum
*   **Database:** MySQL
*   **Testing:** Pest PHP
*   **Localization:** Africa/Mbabane (Eswatini)

---

## 📡 API Architecture

The API implements a unified response structure to ensure a seamless frontend experience:

### Success Response
```json
{
  "success": true,
  "message": "Resource retrieved successfully.",
  "data": { ... }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Clear, descriptive error message for the user.",
  "errors": { ... }
}
```

---

## 📦 Getting Started

1. **Clone & Install:**
   ```bash
   git clone https://github.com/MazweMavuso/sms.git
   composer install
   ```

2. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Initialize Database:**
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## 🤝 Contribution & Maintenance

This project is maintained through high-level prompting. Contributions should focus on strategic improvements that can be implemented via agentic workflows.

**Developed with 💡 and 🤖 to stay ahead of the curve.**
