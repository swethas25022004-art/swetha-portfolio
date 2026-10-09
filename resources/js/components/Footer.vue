<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const currentYear = new Date().getFullYear()

const quickLinks = [
  { label: 'Home', href: '#home' },
  { label: 'About Me', href: '#about' },
  { label: 'Skills', href: '#skills' },
  { label: 'Experience', href: '#experience' },
  { label: 'Projects', href: '#projects' },
  { label: 'Certificates', href: '#certificates' },
  { label: 'Contact', href: '#contact' },
]

const socialLinks = [
  {
    label: 'GitHub',
    href: 'https://github.com/SwethaAppspire',
    description: 'Explore my work',
  },
  {
    label: 'LinkedIn',
    href: 'https://www.linkedin.com/in/swetha-s2502',
    description: 'Connect professionally',
  },
]

const email = 'swethas25022004@gmail.com'

const showBackToTop = ref(false)

let scrollHandler

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth',
  })
}

onMounted(() => {
  scrollHandler = () => {
    showBackToTop.value = window.scrollY > 400
  }

  window.addEventListener('scroll', scrollHandler, { passive: true })
  scrollHandler()
})

onUnmounted(() => {
  if (scrollHandler) {
    window.removeEventListener('scroll', scrollHandler)
  }
})
</script>

<template>
  <footer class="portfolio-footer" id="footer">
    <!-- Animated background -->
    <div class="footer-background" aria-hidden="true">
      <div class="footer-grid"></div>
      <div class="glow glow-purple"></div>
      <div class="glow glow-cyan"></div>

      <span
        v-for="n in 16"
        :key="n"
        class="floating-particle"
        :style="{
          '--i': n,
          '--x': `${(n * 37) % 100}%`,
          '--y': `${(n * 23) % 100}%`,
        }"
      ></span>
    </div>

    <!-- Animated top line -->
    <div class="footer-top-line">
      <span></span>
    </div>

    <div class="footer-container">
      <!-- Main content -->
      <div class="footer-main">
        <!-- Brand section -->
        <div class="footer-brand">
          <a href="#home" class="footer-logo" aria-label="Swetha home">
            S<span>.</span>
          </a>

          <p class="footer-eyebrow">
            <span class="eyebrow-dot"></span>
            THANKS FOR VISITING
          </p>

          <h2>
            Let's build something
            <span class="gradient-text">meaningful.</span>
          </h2>

          <p class="footer-description">
            MCA Graduate and Full Stack Developer passionate about
            building modern, responsive and user-friendly web experiences.
            Always learning, creating and improving.
          </p>

          <a :href="`mailto:${email}`" class="footer-email">
            <span class="email-icon">↗</span>
            <span>{{ email }}</span>
          </a>
        </div>

        <!-- Quick navigation -->
        <div class="footer-column">
          <p class="column-index">01 / NAVIGATION</p>
          <h3>Explore</h3>

          <nav class="footer-nav" aria-label="Footer navigation">
            <a
              v-for="link in quickLinks"
              :key="link.label"
              :href="link.href"
            >
              <span class="nav-arrow">↗</span>
              <span>{{ link.label }}</span>
            </a>
          </nav>
        </div>

        <!-- Social section -->
        <div class="footer-column footer-connect">
          <p class="column-index">02 / GET IN TOUCH</p>
          <h3>Let's connect</h3>

          <p class="connect-description">
            Have a project, opportunity or idea?
            Let's connect and create something valuable.
          </p>

          <a
            v-for="social in socialLinks"
            :key="social.label"
            :href="social.href"
            target="_blank"
            rel="noopener noreferrer"
            class="social-link"
          >
            <span class="social-copy">
              <strong>{{ social.label }}</strong>
              <small>{{ social.description }}</small>
            </span>

            <span class="social-arrow">↗</span>
          </a>

          <a :href="`mailto:${email}`" class="contact-cta">
            Start a conversation
            <span>↗</span>
          </a>
        </div>
      </div>

      <!-- Bottom bar -->
      <div class="footer-bottom">
        <p class="copyright">
          © {{ currentYear }} <strong>Swetha S.</strong>
          <span>All rights reserved.</span>
        </p>

        <p class="footer-built">
          Designed with care
          <span class="footer-heart">♥</span>
          and built with passion.
        </p>

        <button
          class="back-to-top"
          type="button"
          @click="scrollToTop"
          :class="{ visible: showBackToTop }"
          aria-label="Scroll back to top"
        >
          <span>↑</span>
          Back to top
        </button>
      </div>
    </div>
  </footer>
</template>

<style scoped>
/* =========================================
   FOOTER BASE
========================================= */

.portfolio-footer {
  --footer-purple: #a78bfa;
  --footer-cyan: #67e8f9;
  --footer-muted: #929bad;

  position: relative;
  isolation: isolate;
  overflow: hidden;
  background:
    radial-gradient(
      ellipse at 50% 0%,
      rgba(91, 55, 170, 0.13),
      transparent 55%
    ),
    #080b13;
  color: #f4f5f7;
  font-family: inherit;
}

.footer-container {
  position: relative;
  z-index: 2;
  width: min(1180px, calc(100% - 64px));
  margin: 0 auto;
}

/* =========================================
   ANIMATED BACKGROUND
========================================= */

.footer-background {
  position: absolute;
  z-index: -1;
  inset: 0;
  overflow: hidden;
  pointer-events: none;
}

.footer-grid {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(167, 139, 250, 0.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(167, 139, 250, 0.035) 1px, transparent 1px);
  background-size: 46px 46px;
  -webkit-mask-image: linear-gradient(
    to bottom,
    black,
    transparent 95%
  );
  mask-image: linear-gradient(
    to bottom,
    black,
    transparent 95%
  );
  animation: grid-drift 24s linear infinite;
}

.glow {
  position: absolute;
  width: 340px;
  height: 340px;
  border-radius: 50%;
  filter: blur(95px);
  opacity: 0.13;
  will-change: transform;
}

.glow-purple {
  top: 0;
  left: -120px;
  background: #8b5cf6;
  animation: purple-float 12s ease-in-out infinite alternate;
}

.glow-cyan {
  right: -130px;
  bottom: -100px;
  background: #0891b2;
  animation: cyan-float 15s ease-in-out infinite alternate;
}

.floating-particle {
  position: absolute;
  top: var(--y);
  left: var(--x);
  width: 3px;
  height: 3px;
  border-radius: 50%;
  background: var(--footer-purple);
  opacity: 0;
  box-shadow: 0 0 12px rgba(167, 139, 250, 0.6);
  animation: particle-rise calc(8s + var(--i) * 0.55s) ease-in-out infinite;
  animation-delay: calc(var(--i) * -0.8s);
}

.floating-particle:nth-child(3n) {
  background: var(--footer-cyan);
  box-shadow: 0 0 12px rgba(103, 232, 249, 0.55);
}

.floating-particle:nth-child(4n) {
  width: 2px;
  height: 2px;
}

@keyframes grid-drift {
  from {
    background-position: 0 0;
  }
  to {
    background-position: 46px 46px;
  }
}

@keyframes purple-float {
  from {
    transform: translate(0, 0);
  }
  to {
    transform: translate(100px, 60px);
  }
}

@keyframes cyan-float {
  from {
    transform: translate(0, 0);
  }
  to {
    transform: translate(-100px, -60px);
  }
}

@keyframes particle-rise {
  0% {
    transform: translateY(25px) scale(0.5);
    opacity: 0;
  }
  25% {
    opacity: 0.7;
  }
  75% {
    opacity: 0.4;
  }
  100% {
    transform: translateY(-100px) scale(1.2);
    opacity: 0;
  }
}

/* =========================================
   ANIMATED TOP BORDER
========================================= */

.footer-top-line {
  position: relative;
  width: 100%;
  height: 2px;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.07);
}

.footer-top-line span {
  position: absolute;
  top: 0;
  left: -35%;
  width: 35%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    #8b5cf6,
    #67e8f9,
    transparent
  );
  animation: light-sweep 6s ease-in-out infinite;
}

@keyframes light-sweep {
  0% {
    left: -35%;
  }
  100% {
    left: 100%;
  }
}

/* =========================================
   MAIN FOOTER GRID
========================================= */

.footer-main {
  display: grid;
  grid-template-columns: 1.55fr 0.7fr 1fr;
  gap: clamp(35px, 5vw, 76px);
  padding: 76px 0 64px;
}

.footer-brand {
  max-width: 430px;
}

/* =========================================
   BRAND
========================================= */

.footer-logo {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 49px;
  height: 49px;
  margin-bottom: 27px;
  border: 1px solid rgba(167, 139, 250, 0.3);
  border-radius: 15px;
  background: linear-gradient(
    145deg,
    rgba(167, 139, 250, 0.15),
    rgba(103, 232, 249, 0.035)
  );
  box-shadow: 0 0 30px rgba(139, 92, 246, 0.08);
  color: #ffffff;
  font-size: 27px;
  font-weight: 800;
  text-decoration: none;
  transition:
    transform 0.3s ease,
    border-color 0.3s ease,
    box-shadow 0.3s ease;
}

.footer-logo span {
  color: var(--footer-purple);
}

.footer-logo:hover {
  transform: translateY(-4px) rotate(-4deg);
  border-color: var(--footer-purple);
  box-shadow: 0 8px 30px rgba(139, 92, 246, 0.2);
}

.footer-eyebrow {
  display: flex;
  align-items: center;
  gap: 9px;
  margin: 0 0 16px;
  color: #a9b2c5;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 2px;
}

.eyebrow-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #67e8a5;
  box-shadow: 0 0 12px rgba(103, 232, 165, 0.55);
  animation: dot-pulse 2.2s ease-in-out infinite;
}

@keyframes dot-pulse {
  50% {
    box-shadow: 0 0 0 5px rgba(103, 232, 165, 0.08);
  }
}

.footer-brand h2 {
  margin: 0 0 18px;
  color: #f8fafc;
  font-size: clamp(26px, 3vw, 35px);
  font-weight: 750;
  line-height: 1.3;
  letter-spacing: -1.1px;
}

.gradient-text {
  display: block;
  width: fit-content;
  color: #bba7ff;
  background: linear-gradient(
    100deg,
    #c4b5fd 5%,
    #a78bfa 45%,
    #67e8f9 95%
  );
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.footer-description {
  max-width: 380px;
  margin: 0 0 25px;
  color: var(--footer-muted);
  font-size: 13px;
  line-height: 1.95;
  overflow-wrap: anywhere;
}

.footer-email {
  display: inline-flex;
  align-items: center;
  gap: 11px;
  max-width: 100%;
  color: #e5e7eb;
  font-size: 12px;
  text-decoration: none;
  overflow-wrap: anywhere;
  transition: color 0.3s ease;
}

.email-icon {
  display: inline-flex;
  flex-shrink: 0;
  align-items: center;
  justify-content: center;
  width: 31px;
  height: 31px;
  border: 1px solid rgba(167, 139, 250, 0.3);
  border-radius: 50%;
  background: rgba(139, 92, 246, 0.08);
  color: #c4b5fd;
  transition:
    background 0.3s ease,
    transform 0.3s ease;
}

.footer-email:hover {
  color: #c4b5fd;
}

.footer-email:hover .email-icon {
  transform: translate(2px, -2px);
  background: rgba(139, 92, 246, 0.2);
}

/* =========================================
   FOOTER COLUMNS
========================================= */

.column-index {
  margin: 7px 0 13px;
  color: #7e87a0;
  font-size: 9px;
  font-weight: 600;
  letter-spacing: 1.5px;
}

.footer-column h3 {
  margin: 0 0 27px;
  color: #f9fafb;
  font-size: 17px;
  font-weight: 650;
  letter-spacing: -0.2px;
}

.footer-nav {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 17px;
}

.footer-nav a {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  color: #9ba4b5;
  font-size: 12px;
  text-decoration: none;
  transition:
    color 0.25s ease,
    transform 0.25s ease;
}

.nav-arrow {
  color: var(--footer-purple);
  opacity: 0;
  transform: translateX(-5px);
  transition:
    opacity 0.25s ease,
    transform 0.25s ease;
}

.footer-nav a:hover {
  color: #ffffff;
  transform: translateX(4px);
}

.footer-nav a:hover .nav-arrow {
  opacity: 1;
  transform: translateX(0);
}

/* =========================================
   CONNECT SECTION
========================================= */

.connect-description {
  margin: 0 0 20px;
  color: var(--footer-muted);
  font-size: 12px;
  line-height: 1.9;
}

.social-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 12px;
  margin-bottom: 9px;
  border: 1px solid rgba(255, 255, 255, 0.075);
  border-radius: 11px;
  background: rgba(255, 255, 255, 0.018);
  color: #e5e7eb;
  text-decoration: none;
  transition:
    border-color 0.3s ease,
    background 0.3s ease,
    transform 0.3s ease;
}

.social-copy {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.social-copy strong {
  font-size: 12px;
  font-weight: 650;
}

.social-copy small {
  color: #8993a6;
  font-size: 10px;
}

.social-arrow {
  display: inline-flex;
  flex-shrink: 0;
  align-items: center;
  justify-content: center;
  width: 28px;
  height: 28px;
  border-radius: 8px;
  background: rgba(139, 92, 246, 0.1);
  color: #c4b5fd;
  transition:
    transform 0.3s ease,
    background 0.3s ease;
}

.social-link:hover {
  transform: translateY(-2px);
  border-color: rgba(167, 139, 250, 0.35);
  background: rgba(139, 92, 246, 0.07);
}

.social-link:hover .social-arrow {
  transform: translate(2px, -2px);
  background: rgba(139, 92, 246, 0.2);
}

.contact-cta {
  display: inline-flex;
  align-items: center;
  justify-content: space-between;
  gap: 18px;
  margin-top: 10px;
  padding: 12px 15px;
  border: 1px solid rgba(167, 139, 250, 0.35);
  border-radius: 9px;
  background: linear-gradient(
    110deg,
    rgba(139, 92, 246, 0.16),
    rgba(34, 211, 238, 0.06)
  );
  color: #e9e5ff;
  font-size: 11px;
  font-weight: 600;
  text-decoration: none;
  transition:
    border-color 0.3s ease,
    transform 0.3s ease,
    background 0.3s ease;
}

.contact-cta span {
  color: #67e8f9;
  font-size: 16px;
}

.contact-cta:hover {
  transform: translateY(-3px);
  border-color: #a78bfa;
  background: rgba(139, 92, 246, 0.19);
}

/* =========================================
   BOTTOM BAR
========================================= */

.footer-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  min-height: 79px;
  padding: 20px 0;
  border-top: 1px solid rgba(255, 255, 255, 0.09);
}

.footer-bottom p {
  margin: 0;
  color: #8e98aa;
  font-size: 10px;
  line-height: 1.8;
}

.copyright strong {
  color: #e5e7eb;
  font-weight: 600;
}

.copyright > span {
  margin-left: 5px;
  color: #737d91;
}

.footer-built {
  text-align: center;
}

.footer-heart {
  display: inline-block;
  padding: 0 3px;
  color: #c4b5fd;
  animation: heart-beat 2s ease-in-out infinite;
}

@keyframes heart-beat {
  0%,
  100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.2);
  }
}

/* =========================================
   BACK TO TOP
========================================= */

.back-to-top {
  display: inline-flex;
  flex-shrink: 0;
  align-items: center;
  gap: 9px;
  padding: 9px 12px;
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 9px;
  background: rgba(255, 255, 255, 0.025);
  color: #b4bdcd;
  font-family: inherit;
  font-size: 10px;
  cursor: pointer;
  transition:
    border-color 0.25s ease,
    background 0.25s ease,
    color 0.25s ease,
    transform 0.25s ease;
}

.back-to-top > span {
  color: #c4b5fd;
  font-size: 17px;
  transition: transform 0.25s ease;
}

.back-to-top:hover {
  transform: translateY(-3px);
  border-color: rgba(167, 139, 250, 0.5);
  background: rgba(139, 92, 246, 0.09);
  color: #ffffff;
}

.back-to-top:hover > span {
  transform: translateY(-3px);
}

/* =========================================
   TABLET RESPONSIVE
========================================= */

@media (max-width: 900px) {
  .footer-main {
    grid-template-columns: 1.2fr 0.8fr;
    gap: 48px 40px;
  }

  .footer-brand {
    grid-column: 1 / -1;
    max-width: 560px;
  }

  .footer-connect {
    max-width: 360px;
  }

  .footer-bottom {
    flex-wrap: wrap;
  }
}

/* =========================================
   MOBILE RESPONSIVE
========================================= */

@media (max-width: 600px) {
  .footer-container {
    width: calc(100% - 40px);
  }

  .footer-main {
    grid-template-columns: 1fr;
    gap: 39px;
    padding: 48px 0 38px;
  }

  .footer-brand {
    grid-column: auto;
  }

  .footer-logo {
    margin-bottom: 22px;
  }

  .footer-brand h2 {
    font-size: 28px;
  }

  .footer-description {
    font-size: 12px;
  }

  .footer-column h3 {
    margin-bottom: 20px;
  }

  .footer-nav {
    gap: 15px;
  }

  .nav-arrow {
    opacity: 1;
    transform: none;
  }

  .footer-bottom {
    align-items: flex-start;
    flex-direction: column;
    gap: 13px;
    padding: 22px 0;
  }

  .footer-built {
    text-align: left;
  }

  .back-to-top {
    margin-top: 3px;
  }

  .glow {
    width: 230px;
    height: 230px;
    filter: blur(75px);
  }
}

/* =========================================
   ACCESSIBILITY
========================================= */

@media (prefers-reduced-motion: reduce) {
  .portfolio-footer *,
  .portfolio-footer *::before,
  .portfolio-footer *::after {
    animation: none !important;
    scroll-behavior: auto !important;
    transition-duration: 0.01ms !important;
  }

  .footer-grid {
    animation: none;
  }
}
</style>