<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loyalty Backend Dashboard</title>
    <style>
        :root {
            color-scheme: light;
            --bg: #f3f4f6;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #475569;
            --accent: #2563eb;
            --accent-modul3: #7c3aed;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 20px 48px;
        }
        .hero, .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 16px;
        }
        h1 { margin: 0 0 8px; font-size: 28px; }
        h2 { margin: 0 0 12px; font-size: 20px; }
        p { margin: 0; color: var(--muted); line-height: 1.5; }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 12px;
            margin-top: 18px;
        }
        .stat {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px;
            background: #f8fafc;
        }
        .stat .label { color: var(--muted); font-size: 13px; margin-bottom: 6px; }
        .stat .value { font-weight: 700; font-size: 24px; }
        
        .links a {
            display: inline-block;
            margin: 8px 10px 0 0;
            padding: 10px 12px;
            border-radius: 8px;
            text-decoration: none;
            border: 1px solid var(--border);
            font-weight: 600;
            transition: all 0.2s;
        }
        .modul1-link { color: var(--accent); background: #eff6ff; }
        .modul1-link:hover { background: var(--accent); color: white; }
        .modul3-link { color: var(--accent-modul3); background: #f3e8ff; }
        .modul3-link:hover { background: var(--accent-modul3); color: white; }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        button {
            padding: 10px 20px;
            background: var(--accent-modul3);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover { background: #6d28d9; }
        
        /* ========== RESULT BOX - TIDAK MELEBAR ========== */
        .result-wrapper {
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
        }
        .result-box {
            background: #1e293b;
            color: #e2e8f0;
            padding: 12px;
            font-family: monospace;
            font-size: 11px;
            max-height: 200px;
            overflow-x: auto;      /* Scroll horizontal jika konten panjang */
            overflow-y: auto;       /* Scroll vertikal jika konten tinggi */
            white-space: pre-wrap;  /* Wrap teks agar tidak melebar */
            word-break: break-all;  /* Potong kata jika terlalu panjang */
            word-wrap: break-word;  /* Wrap untuk browser lama */
            max-width: 100%;        /* Tidak melebihi parent */
            display: block;
        }
        .result-box pre {
            margin: 0;
            white-space: pre-wrap;
            word-break: break-all;
            font-family: monospace;
            font-size: 11px;
        }
        .result-box-error {
            background: #450a0a;
        }
        
        .token-box {
            background: #fef3c7;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            word-break: break-all;
            font-family: monospace;
            font-size: 11px;
        }
        .success-text { color: var(--success); }
        .error-text { color: var(--danger); }
        .separator {
            margin: 24px 0;
            text-align: center;
            position: relative;
        }
        .separator span {
            background: var(--bg);
            padding: 0 12px;
            color: var(--muted);
            font-size: 14px;
        }
        .separator::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--border);
            z-index: 0;
        }
        .separator span { position: relative; z-index: 1; }
        .footer {
            font-size: 12px;
            color: var(--muted);
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            text-align: center;
        }
        .two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        @media (max-width: 768px) {
            .two-columns { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- ==================== MODUL 1 ==================== -->
    <section class="hero">
        <h1>Loyalty Backend - Modul 1</h1>
        <p>Dashboard sederhana untuk melihat status modul Activity Rules and Rewards.</p>
        <div class="grid">
            <div class="stat">
                <div class="label">Total Activity Rules</div>
                <div class="value">{{ number_format($modul1['stats']['activity_rules']) }}</div>
            </div>
            <div class="stat">
                <div class="label">Total Rewards</div>
                <div class="value">{{ number_format($modul1['stats']['rewards']) }}</div>
            </div>
            <div class="stat">
                <div class="label">Point Activity Logs</div>
                <div class="value">{{ number_format($modul1['stats']['activity_logs']) }}</div>
            </div>
        </div>
    </section>

    <section class="panel">
        <h2>Quick API Links</h2>
        <p>Akses endpoint utama modul langsung dari browser.</p>
        <div class="links">
            <a href="/api/activity-rules" target="_blank" class="modul1-link">GET Activity Rules</a>
            <a href="/api/rewards" target="_blank" class="modul1-link">GET Rewards</a>
        </div>
    </section>

    <!-- ==================== PEMISAH ==================== -->
    <div class="separator"><span>✦ MODUL 3 ✦</span></div>

    <!-- ==================== MODUL 3 ==================== -->
    <section class="hero">
        <h1>Loyalty Backend - Modul 3</h1>
        <p>Autentikasi Member (JWT), E-Statement, dan Masa Berlaku Poin.</p>
        <div class="grid">
            <div class="stat">
                <div class="label">Total Users</div>
                <div class="value">{{ number_format($modul3['stats']['total_users']) }}</div>
            </div>
            <div class="stat">
                <div class="label">New Users Today</div>
                <div class="value">{{ number_format($modul3['stats']['new_users_today']) }}</div>
            </div>
            <div class="stat">
                <div class="label">Total Points Earned</div>
                <div class="value">{{ number_format($modul3['stats']['total_points_earned']) }}</div>
            </div>
            <div class="stat">
                <div class="label">Active Points</div>
                <div class="value">{{ number_format($modul3['stats']['active_points']) }}</div>
            </div>
            <div class="stat">
                <div class="label">Points Redeemed</div>
                <div class="value">{{ number_format($modul3['stats']['total_points_redeemed']) }}</div>
            </div>
            <div class="stat">
                <div class="label">⚠️ Expiring Soon</div>
                <div class="value" style="color: #f59e0b;">{{ number_format($modul3['stats']['points_expiring_soon']) }}</div>
            </div>
        </div>
    </section>

    <!-- FORM REGISTER & LOGIN -->
    <div class="two-columns">
        <!-- REGISTER FORM -->
        <div class="panel">
            <h2>📝 Register</h2>
            <form id="registerForm">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" id="reg_name" placeholder="Masukkan nama" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="reg_email" placeholder="Masukkan email" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="reg_password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" id="reg_password_confirmation" placeholder="Konfirmasi password" required>
                    </div>
                </div>
                <button type="submit">Register & Get Token</button>
            </form>
            <div id="registerResult" style="display: none;"></div>
        </div>

        <!-- LOGIN FORM -->
        <div class="panel">
            <h2>🔐 Login</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="login_email" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="login_password" placeholder="Password" required>
                </div>
                <button type="submit">Login & Get Token</button>
            </form>
            <div id="loginResult" style="display: none;"></div>
        </div>
    </div>

    <!-- TEST PROTECTED ENDPOINTS -->
    <div class="panel">
        <h2>🔒 Test Protected Endpoints (Butuh Token)</h2>
        <div class="form-group">
            <label>JWT Token (akan otomatis terisi setelah register/login)</label>
            <textarea id="currentToken" rows="2" style="width: 100%; font-family: monospace; font-size: 11px; resize: vertical;" placeholder="Token akan muncul di sini..."></textarea>
        </div>
        <div class="links">
            <button onclick="testProtected('GET', '/api/me')" class="modul3-link" style="background: #f3e8ff;">👤 GET /api/me</button>
            <button onclick="testProtected('GET', '/api/points/balance')" class="modul3-link" style="background: #f3e8ff;">💰 GET /api/points/balance</button>
            <button onclick="testProtected('GET', '/api/statement')" class="modul3-link" style="background: #f3e8ff;">📄 GET /api/statement</button>
            <button onclick="testProtected('POST', '/api/logout')" class="modul3-link" style="background: #f3e8ff;">🚪 POST /api/logout</button>
        </div>
        <div id="protectedResult" style="display: none; margin-top: 15px;"></div>
    </div>

    <div class="footer">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }}
    </div>
</div>

<script>
// Global variable untuk menyimpan token
let currentToken = localStorage.getItem('jwt_token') || '';

// Tampilkan token jika ada
if (currentToken) {
    document.getElementById('currentToken').value = currentToken;
}

function saveToken(token) {
    currentToken = token;
    localStorage.setItem('jwt_token', token);
    document.getElementById('currentToken').value = token;
}

function showResult(elementId, data, isError = false) {
    const element = document.getElementById(elementId);
    element.style.display = 'block';
    // Gunakan wrapper dan box dengan ukuran tetap
    element.innerHTML = `<div class="result-wrapper">
        <div class="result-box ${isError ? 'result-box-error' : ''}">
            <pre>${JSON.stringify(data, null, 2)}</pre>
        </div>
    </div>`;
}

async function testProtected(method, url) {
    const token = document.getElementById('currentToken').value;
    if (!token) {
        alert('❌ Token required! Please register or login first.');
        return;
    }
    
    try {
        const response = await fetch(url, {
            method: method,
            headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
        });
        const data = await response.json();
        showResult('protectedResult', data, !response.ok);
    } catch (error) {
        showResult('protectedResult', { error: error.message }, true);
    }
}

// Register Form
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const data = {
        name: document.getElementById('reg_name').value,
        email: document.getElementById('reg_email').value,
        password: document.getElementById('reg_password').value,
        password_confirmation: document.getElementById('reg_password_confirmation').value
    };
    
    try {
        const response = await fetch('/api/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        showResult('registerResult', result, !response.ok);
        
        if (result.success && result.data.token) {
            saveToken(result.data.token);
            alert('✅ Registration successful! Token saved.');
        }
    } catch (error) {
        showResult('registerResult', { error: error.message }, true);
    }
});

// Login Form
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const data = {
        email: document.getElementById('login_email').value,
        password: document.getElementById('login_password').value
    };
    
    try {
        const response = await fetch('/api/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        showResult('loginResult', result, !response.ok);
        
        if (result.success && result.data.token) {
            saveToken(result.data.token);
            alert('✅ Login successful! Token saved.');
        }
    } catch (error) {
        showResult('loginResult', { error: error.message }, true);
    }
});
</script>
</body>
</html>