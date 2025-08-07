Journal-ICB-CT
A Laravel-based Journal Management System for Computational Biology & Technology

📌 Overview
Journal-ICB-CT is a web-based journal management system designed for publishing and managing research articles in Computational Biology and Technology (CT). Built with Laravel and MySQL, this platform provides an efficient workflow for article submission, peer review, and publication.

The system supports three user roles:

Super Admin (Full access to all features)

Teacher/Reviewer (Access to submissions, reviews, and reports)

Student/Author (Submit articles, track progress, and manage profile)

✨ Key Features
✅ Multi-Role Access Control

Super Admin: Full system control (users, settings, logs).

Teacher/Reviewer: Access to Dashboard, Company Data, Student Data, Categories, Reports, and Profile.

Student/Author: Access to Dashboard, Profile, User Management, and Activity Logging.

✅ Article Management

Submit, review, and publish articles.

Track submission status (Pending, Under Review, Accepted, Rejected).

✅ Interactive Dashboard

Data visualization with Chart.js.

Real-time notifications via Pusher & Laravel Echo.

✅ Responsive UI

Built with Tailwind CSS, Alpine.js, and Font Awesome.

Optimized CDN delivery via Bunny Fonts, jsDelivr, Cloudflare, and jQuery CDN.

✅ Security & Performance

Secure authentication & role-based permissions.

Hosted on Railway for scalability.

🛠️ Tech Stack
Category	Technologies Used
Backend	Laravel, PHP, MySQL
Frontend	Alpine.js, Tailwind CSS, jQuery
UI/UX	Font Awesome, Bunny Fonts
Charts	Chart.js
Real-Time	Pusher, Laravel Echo
Alerts	SweetAlert
APIs	Axios
Hosting	Railway
CDN	Cloudflare, Bunny, jsDelivr, jQuery CDN
👥 User Roles & Permissions
1. Super Admin
🔐 Full system access

👥 Manage users (Teachers & Students)

⚙️ Configure system settings

📊 View all reports & logs

2. Teacher/Reviewer
📂 Access:

Dashboard

Company Data

Student Data

Categories

Reports

Profile

✏️ Review & approve/reject submissions

3. Student/Author
📂 Access:

Dashboard

Profile

User Management (limited)

Activity Logging (input kegiatan)

📄 Submit & track articles

🚀 Installation
Clone the repository

bash
git clone https://github.com/icb-2025/Journal-ICB-CT.git
cd journal-icb-ct
Install dependencies

bash
composer install
npm install
Configure environment

Copy .env.example to .env

Set up MySQL, Pusher, and Cloudflare CDN keys.

Run migrations & seed dummy data

bash
php artisan migrate --seed
Start the development server

bash
php artisan serve
npm run dev
🔗 Live Demo
🌐 Website: https://journal-icb-ct-production.up.railway.app

📧 Contact
📧 Email: arifiputrafaqih@gmail.com
🔗 Issue Tracker: GitHub Issues

📜 License
MIT Licensed. © 2025 Journal-ICB-CT

🎯 Future Improvements
AI-based plagiarism checker

Mobile app integration

Crossref DOI integration

🚀 Happy Researching! 🎓📚
