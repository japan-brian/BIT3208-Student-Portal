<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile – EduTrack Developer</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#f5f6fa; }
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            max-width: 700px;
            margin: 0 auto;
        }
        .profile-pic {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #4f46e5;
            margin-bottom: 16px;
        }
        .profile-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 32px rgba(79,70,229,0.08);
            width: 100%;
            text-align: center;
        }
        h1 { color:#1e1e2e; margin-bottom:4px; }
        .role { color:#6b7280; font-size:14px; margin-bottom:20px; }
        .about { text-align:left; color:#374151; line-height:1.6; margin-bottom:20px; }
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .contact-info div {
            background: #ede9fe;
            color: #4f46e5;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
        }

        /* Tablet+ : contact info goes horizontal */
        @media (min-width: 768px) {
            .profile-container { flex-direction: row; align-items: flex-start; gap: 30px; }
            .profile-pic { width: 180px; height: 180px; }
            .contact-info { flex-direction: row; flex-wrap: wrap; }
            .profile-card { text-align: left; }
            .about { text-align: left; }
        }

        @media (min-width: 1024px) {
            .profile-container { max-width: 900px; }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img src="https://ui-avatars.com/api/?name=Brian+Kikuyu&size=200&background=4f46e5&color=fff" 
             alt="Brian Kikuyu" class="profile-pic">
        <div class="profile-card">
            <h1>Brian Kikuyu (JAYP)</h1>
            <p class="role">Computer Science Student · AI/ML · Founder, HoneypotAdvisory</p>
            <div class="about">
                <p>Final-year Computer Science student at Mount Kenya University, 
                specializing in AI/ML. Building EduTrack as a capstone project — a 
                role-based student management system with secure authentication and 
                full CRUD functionality. Also founder of HoneypotAdvisory, an 
                AI-powered recruitment platform, and a GDG on Campus lead at MKU.</p>
            </div>
            <div class="contact-info">
                <div>📧 your-email@example.com</div>
                <div>💻 github.com/japan-brian</div>
                <div>📍 Thika, Kenya</div>
            </div>
        </div>
    </div>
</body>
</html>