# 🚀 Uptime Monitoring System

A robust Laravel-based solution for monitoring website availability, SSL certificates, and server status with real-time alerts.

## 🌟 Features

### 🖥 Monitoring
- HTTP/HTTPS status checks
- DNS record validation
- Ping availability testing
- Port scanning
- SSL certificate expiration tracking

### 🔔 Notifications
- Email alerts (SMTP)
- Telegram bot integration

### 💳 Payment Integration  
- Subscription-based plans (Free/Premium)  
- Integrated **Cashfree** payment gateway for seamless transactions with webhook
-   


### 👤 User Management
- Multi-tier authentication (Free/Premium)
- Role-based dashboard access

## 🔑 User Access Levels
- **Free Tier**: Up to 5 monitors, email + Telegram alerts, priority support.
- **Premium Tier**: Unlimited monitors, email + Telegram alerts, priority support.

### 📊 Dashboard
- Real-time status charts (Chart.js)
- Historical uptime statistics
- Incident timeline

## **🛠 Tech Stack**  
- **Frontend**: Blade, Bootstrap v4.5  
- **Backend**: Laravel v10, MySQL  
- **Monitoring**:chart.js library  
- **Logging**: Spatie Laravel package for Activity Log  
---

## **📌 Installation**  

1️⃣ **Clone the Repository**  
```bash
git clone https://github.com/your-username/uptime-monitoring.git
cd uptime-monitoring
```

2️⃣ **Install Dependencies**  
```bash
composer install
npm install
```

3️⃣ **Setup Environment**  
```bash
cp .env.example .env
php artisan key:generate
```
Edit `.env` and configure **database credentials**.

4️⃣ **Run Migrations**  
```bash
php artisan migrate
```

5️⃣ **Seed Data (Optional)**  
```bash
php artisan db:seed
```

6️⃣ **Start Development Server**  
```bash
php artisan serve
```
💰 Setting Up Cashfree Payments
---
1️⃣ **Register on Cashfree and obtain your API keys.**  
Update .env with the following:
```bash
CASHFREE_API_KEY=
CASHFREE_API_SECRET=
```
## 📸 Snapshots 

### 📍 **Landing Page**  
<img width="1898" height="961" alt="Screenshot 2026-04-21 232015" src="https://github.com/user-attachments/assets/da14a1de-c2b2-475b-b121-78fd77130810" />

### **User Dashboard**  
<!-- ![Dashboard](your-screenshot-path/dashboard.png)   -->
<img width="1917" height="960" alt="Screenshot 2026-04-21 232506" src="https://github.com/user-attachments/assets/c898a364-5121-412b-8c16-b6d0082ece07" />

### **Add Monitor** 
<img width="1906" height="972" alt="image" src="https://github.com/user-attachments/assets/e271ec20-d8c7-4109-8e5f-d6229e58f94c" />

###  **Incident History** 
<img width="1917" height="957" alt="image" src="https://github.com/user-attachments/assets/a7cf205a-ff59-48e2-a9ab-438ee7dd39c0" />


### 📉 **Historical Uptime Graph**  
<!-- ![Uptime Graph](your-screenshot-path/uptime-graph.png)   -->
<img width="1900" height="968" alt="image" src="https://github.com/user-attachments/assets/ecb6d82c-25a1-4cf3-987d-3ffad974f0a9" />

### 💳 **Cashfree Payment Integration**  

![alt text](payemtt222.png)

## **Admin Dashboard**
<img width="1897" height="970" alt="image" src="https://github.com/user-attachments/assets/b2282aea-96e3-4959-96ec-09e9fbc1c3cd" />


---

## **📢 Contributing**  
Contributions are welcome! Feel free to open issues or submit pull requests.  

---
