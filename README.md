# 📂 PHP-FTP-Uploader  
**Simple PHP File Uploader to FTP with User Login**  
by Tom Salaj

![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)
![Made with PHP](https://img.shields.io/badge/Made%20with-PHP-blue?logo=php)

---

## 🧰 What is it?

A minimalist PHP tool to upload files to an FTP server – with your own username and password, no database needed.

Designed for **learning purposes**, personal tools, or quick internal solutions.

---

## ⚙️ Setup

### 🔐 1. Login Credentials

In `login.php`, set your credentials:

```php
$auth_username = "your-admin-username";
$auth_password = "your-secret-password";
```

### 🌐 2. FTP Configuration

In `upload.php`, configure the following:

```php
$ftp_server     = "FTP-SERVER";
$ftp_username   = "FTP-SERVER-USERNAME";
$ftp_password   = "FTP-SERVER-PASSWORD";
$ftp_target_dir = "/www/your-uploads-folder/";
$base_url       = "https://www.your-domain.com/uploads/";
```

---

## 💡 Notes

- No fancy UI – just a minimal style (`style.css`)
- Uses [Bootstrap](https://getbootstrap.com/) basics (`bootstrap.min.css` + `bootstrap.bundle.min.js`)
- All static files are located in the `files/` folder – customize freely
- Includes a **progress bar** for a smooth visual experience when uploading larger files

---

## 📏 File Size Limit

Want to upload files over **50MB**?  
Make sure your hosting provider allows large uploads via `php.ini`, `.htaccess`, or their dashboard. Limits vary by hosting.

---

## ⚠️ Security Disclaimer

This script is intentionally **minimal and not secure by modern standards**.  
Do **not** use it in production environments without applying proper security practices.

> Use at your own risk. Provided "as is", with no warranty.  
> Intended for educational and experimental use only.

---

## 🪪 License

MIT License — you're free to:

- ✅ use it  
- ✅ modify it  
- ✅ extend it  

See the full [LICENSE](LICENSE) file for details.

---

## 🚀 Final Words

Learn, code, enjoy — good luck!  
**Tom Salaj**
