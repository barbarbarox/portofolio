# Akbar Maulana - Interactive Developer Portfolio

Welcome to the source code of my interactive developer portfolio! This project is a showcase of my skills in building secure, scalable, and aesthetically pleasing web applications, blending robust backend architecture with highly interactive frontend experiences.

## 🚀 Technologies & Stack

This project is built using a modern stack with a strong emphasis on a custom, lightweight, and performant frontend.

### Frontend (UI/UX)
- **HTML5 (Blade Templating):** Semantic HTML structure rendered dynamically via Laravel's Blade engine.
- **Vanilla CSS3:** Fully custom styling without heavy frameworks (No Tailwind or Bootstrap). It features:
  - **Glassmorphism:** Leveraging `backdrop-filter` for modern frosted-glass effects.
  - **CSS Animations:** Extensive use of `@keyframes` for smooth transitions, bouncing effects, and typing simulations (found in `animations.css`).
  - **Custom Layouts:** CSS Grid and Flexbox for responsive designs like the Bento grid layout and centering elements.
- **Vanilla JavaScript (ES6+):** Pure JavaScript for DOM manipulation and interactivity. Key features include:
  - **Intersection Observers:** Used for scroll-triggered animations and number counters (e.g., `magic-bento.js`).
  - **Custom Interactions:** Draggable lanyard elements, card swapping mechanics, and a mobile radial menu that auto-closes upon selection.
- **Vite:** Next-generation frontend tooling for ultra-fast asset bundling and Hot Module Replacement (HMR).
- **Icons:** FontAwesome for scalable vector icons.
- **Advanced UI Components:**
  - Mac OS-style animated terminal typing effects.
  - Interactive Bento grid cards (`.magic-bento-card`) with hover particle effects.
  - Draggable 3D-like Lanyard (`lanyard-desc`).
  - Mobile-optimized radial menu navigation.

### Backend
- **Laravel (PHP):** The core framework serving as the robust backbone, handling routing, views, and server-side logic securely.
- **PostgreSQL / MySQL:** Relational database management for storing dynamic content like projects, skills, and settings.

---

## 🎨 Frontend Architecture

The frontend is designed to be highly modular and maintainable, despite using vanilla technologies:

- `public/css/main.css`: The core stylesheet containing global variables, typography, layout structures, and specific component styles (like the hero terminal, radial menu, and bento cards).
- `public/css/animations.css`: Dedicated file for complex CSS `@keyframes` and transition classes, keeping the main stylesheet clean.
- `public/js/`: Contains modular JavaScript files handling specific interactive components (e.g., `main.js`, `magic-bento.js`, `profile-card.js`, `card-swap.js`).
- `resources/views/portfolio.blade.php`: The main entry point where components are assembled and populated with backend data.

## 📱 Responsiveness & Accessibility

The portfolio is fully responsive, featuring distinct layouts for different devices:
- **Desktop:** Centered pill-navigation bar with hover states.
- **Mobile:** A custom radial menu that allows pure scroll navigation without cluttering the screen with traditional headers. The menu elegantly folds away upon interacting.

## 🛠️ Getting Started (Local Development)

To run this project on your local machine or access it via a local network (e.g., from your phone):

1. **Clone the repository and install dependencies:**
   ```bash
   composer install
   npm install
   ```

2. **Set up the environment:**
   Copy `.env.example` to `.env` and configure your database credentials.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Run the development servers (accessible on local network):**
   Start the Laravel server:
   ```bash
   php artisan serve --host=0.0.0.0
   ```
   Start the Vite asset bundler in a separate terminal:
   ```bash
   npm run dev -- --host
   ```

4. **Access the app:**
   Open your browser and navigate to your machine's local IP address (e.g., `http://192.168.x.x:8000`).

---

*Designed and engineered with a focus on security by default and pixel-perfect aesthetics.*
# portofolio
