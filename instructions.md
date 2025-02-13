**Prompt: Laravel Package Development for Postcard Builder**

You are a highly skilled Laravel package developer tasked with creating a **Postcard Builder** application. Your goal is to generate code, architecture, and best practices that align with Laravel and Vue.js standards. The application should be built using **Laravel Jetstream (Inertia.js + Vue)** and **Tailwind CSS**, following modern coding conventions.

### **Project Overview**
The **Postcard Builder** will allow users to create, preview, and share postcards dynamically. The UI should update in real-time as the user types and should support image uploads for the postcard’s back side. The project should follow Laravel best practices for routing, database models, controllers, and UI updates.

### **Tech Stack**
- **Backend**: Laravel 10+
- **Frontend**: Vue.js (via Inertia.js)
- **CSS Framework**: Tailwind CSS
- **Authentication**: Laravel Jetstream
- **Storage**: Local storage for images
- **Database**: MySQL or PostgreSQL
- **Code Styling**: Laravel Pint
- **Testing**: PestPHP / PHPUnit

### **Features**
1. **Postcard Preview UI**
   - A form where users input text, which updates the postcard preview live.
   - A **WYSIWYG editor** for the message field.
   - Field validation: all fields except “Street Address - Line 2” are required.

2. **Image Upload & Postcard Back UI**
   - Users can upload an image for the back of the postcard.
   - Image is stored in Laravel’s `storage/app/public` directory.
   - A **toggle button** to switch between the front and back of the postcard.
   - Bonus: Image cropping functionality.

3. **Public Postcard Sharing**
   - Generate a unique, shareable link to view a postcard.
   - Bonus: Animated **flip effect** when toggling between the front and back.

### **Additional Development Guidelines**
- Use **PHP 8.3+ features** where appropriate.
- Follow Laravel’s architectural best practices:
  - Use controllers for business logic.
  - Keep models clean and leverage Eloquent relationships.
  - Use Form Requests for validation.
- Maintain **clear and readable code**, following Laravel conventions.
- Implement **testing** for key functionalities.
- Write **documentation** covering:
  - Setup instructions
  - Usage examples
  - API references

---

### **Your Task**
Based on this project description, generate:
1. **A Laravel package structure** that aligns with best practices.
2. **Code examples** for models, controllers, Vue components, and Tailwind-styled UI.
3. **Database schema design** for storing postcards and their attributes.
4. **Authentication handling** using Jetstream.
5. **Best practices for testing and deployment**.

**Output everything in well-structured, documented code and explanations.**

---

This prompt ensures the LLM understands the full scope of your **Postcard Builder** while keeping the responses targeted and useful. Let me know if you need any refinements! 🚀
