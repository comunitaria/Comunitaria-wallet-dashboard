# MonederoILLA

This is an Ionic Angular wallet app using Capacitor.

---

## Prerequisites

- **Node.js**: v18.x or v20.x (minimum required: v18)
- **npm**: v8.x or higher
- **Ionic CLI** (optional, for global commands):  
  ```bash
  npm install -g @ionic/cli
  ```

---

## Setup Instructions

1. **Clone the repository**  
   ```bash
   git clone <repo-url>
   cd appMovil
   ```

2. **Install dependencies**  
   ```bash
   npm install
   ```

3. **Serve the app (development mode)**  
   ```bash
   npm start
   ```
   or
   ```bash
   ionic serve
   ```
   The app will be available at [http://localhost:4200](http://localhost:4200).

4. **Build the app (production)**  
   ```bash
   npm run build
   ```
   or
   ```bash
   ionic build
   ```

5. **Run tests**  
   ```bash
   npm test
   ```

6. **Capacitor (Android/iOS builds)**  
   After building:
   ```bash
   npx cap sync
   npx cap open android   # For Android Studio
   npx cap open ios       # For Xcode (macOS only)
   ```
