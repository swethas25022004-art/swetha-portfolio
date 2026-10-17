```vue
<template>
  <section id="home" class="hero">
    <div class="hero-grid-pattern"></div>
    <div class="hero-glow hero-glow-one"></div>
    <div class="hero-glow hero-glow-two"></div>

    <div class="hero-container">
      <!-- Left: Introduction -->
      <div class="hero-text">
        <div class="hero-eyebrow">
          <span class="eyebrow-line"></span>
          <span>HELLO, I'M</span>
        </div>

        <p class="small-title">
          FULL STACK DEVELOPER
        </p>

        <h1>
          Swetha S <span class="hero-name-accent"></span>
        </h1>

        <h2>
          MCA Graduate
          <span class="heading-divider">/</span>
          <span class="heading-accent">Full Stack Developer</span>
        </h2>

        <p class="hero-description">
          I build modern, responsive, and user-friendly web
          applications. I enjoy transforming ideas into practical
          digital experiences through thoughtful design and
          full-stack development.
        </p>

        <div class="hero-status">
          <span class="status-indicator"></span>
          <span>Currently working as a Full Stack Developer Intern</span>
        </div>

        <!-- Main Actions -->
        <div class="hero-buttons">
          <a href="#projects" class="primary-btn">
            <span>Explore My Work</span>
            <span class="button-arrow" aria-hidden="true">↗</span>
          </a>

          <a
            href="/resume/Swetha_resume.pdf"
            target="_blank"
            rel="noopener noreferrer"
            class="secondary-btn"
          >
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path
                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linejoin="round"
              />
              <path
                d="M14 2v6h6M8 13h8M8 17h8"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
              />
            </svg>
            <span>View Resume</span>
          </a>

          <a
            href="/resume/Swetha_resume.pdf"
            download="Swetha_S_Resume.pdf"
            class="download-link"
          >
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path
                d="M12 3v12m-5-5 5 5 5-5M4 17v3h16v-3"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            Download CV
          </a>
        </div>

        <!-- Social Links -->
        <div class="hero-social-area">
          <span class="social-label">FIND ME ON</span>

          <div class="social-links">
            <a
              href="https://github.com/SwethaAppspire"
              target="_blank"
              rel="noopener noreferrer"
              class="social-link"
            >
              <span>GitHub</span>
              <span aria-hidden="true">↗</span>
            </a>

            <a
              href="https://github.com/swethas25022004-art/project"
              target="_blank"
              rel="noopener noreferrer"
              class="social-link"
            >
              <span>Ethereum Project</span>
              <span aria-hidden="true">↗</span>
            </a>

            <a
              href="https://www.linkedin.com/in/swetha-s2502"
              target="_blank"
              rel="noopener noreferrer"
              class="social-link"
            >
              <span>LinkedIn</span>
              <span aria-hidden="true">↗</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Right: Profile Visual -->
      <div class="hero-image">
        <div class="profile-visual">
          <div class="profile-ring profile-ring-one"></div>
          <div class="profile-ring profile-ring-two"></div>

          <div class="profile-orbit orbit-one"></div>
          <div class="profile-orbit orbit-two"></div>

          <div class="profile-card">
            <div class="profile-card-top">
              <span class="profile-card-dot"></span>
              <span>DEVELOPER PROFILE</span>
              <span class="profile-card-menu">•••</span>
            </div>

            <div class="profile-monogram">
              <span>S</span>
              <span class="monogram-period">.</span>
            </div>

            <div class="profile-card-divider"></div>

            <p class="profile-name">SWETHA S</p>
            <p class="profile-role">FULL STACK DEVELOPER</p>

            <div class="profile-card-bottom">
              <span class="profile-card-line"></span>
              <span>BUILD · LEARN · CREATE</span>
            </div>
          </div>

          <!-- Floating Labels -->
          <div class="floating-chip chip-top">
            <span class="chip-icon">&lt;/&gt;</span>
            <span>Web Development</span>
          </div>

          <div class="floating-chip chip-bottom">
            <span class="chip-sparkle">✦</span>
            <span>Always learning</span>
          </div>

          <div class="decorative-dot decorative-dot-one"></div>
          <div class="decorative-dot decorative-dot-two"></div>
        </div>

        <div class="hero-image-caption">
          <span class="caption-line"></span>
          <span>CREATING WITH PURPOSE</span>
          <span class="caption-line"></span>
        </div>
      </div>
    </div>

    <!-- Scroll Hint -->
    <a href="#about" class="scroll-hint" aria-label="Scroll to About section">
      <span class="scroll-hint-text">SCROLL TO EXPLORE</span>
      <span class="scroll-hint-icon" aria-hidden="true">↓</span>
    </a>
  </section>
</template>

<style scoped>
/* =====================================
   HERO SECTION
===================================== */

.hero {
  position: relative;
  isolation: isolate;
  display: flex;
  align-items: center;
  min-height: 680px;
  padding: 95px 0 90px;
  overflow: hidden;
  background: linear-gradient(135deg, #ffffff 0%, #edf5ff 100%);
  color: #14283f;
}

.hero-container {
  position: relative;
  z-index: 2;
  display: grid;
  grid-template-columns: minmax(0, 1.12fr) minmax(0, 0.88fr);
  align-items: center;
  gap: 55px;
  width: min(1120px, calc(100% - 64px));
  margin: 0 auto;
}

/* =====================================
   BACKGROUND DECORATION
===================================== */

.hero-grid-pattern {
  position: absolute;
  z-index: -1;
  inset: 0;
  background-image:
    linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
  background-size: 55px 55px;
  mask-image: linear-gradient(to right, black, transparent 85%);
  pointer-events: none;
}

.hero-glow {
  position: absolute;
  z-index: -1;
  width: 360px;
  height: 360px;
  border-radius: 50%;
  filter: blur(110px);
  pointer-events: none;
}

.hero-glow-one {
  top: 10%;
  left: -190px;
  background: rgba(57, 120, 194, 0.12);
}

.hero-glow-two {
  right: -180px;
  bottom: 0;
  background: rgba(117, 169, 232, 0.12);
}

/* =====================================
   INTRODUCTION
===================================== */

.hero-text {
  min-width: 0;
  animation: hero-enter 0.8s ease both;
}

.hero-eyebrow {
  display: flex;
  align-items: center;
  gap: 11px;
  margin-bottom: 24px;
  color: #3978c2;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 2.5px;
}

.eyebrow-line {
  width: 29px;
  height: 1px;
  background: #3978c2;
}

.small-title {
  margin: 0 0 12px;
  color: #a7adbb;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 3px;
}

.hero-text h1 {
  margin: 0 0 15px;
  color: #14283f;
  font-size: clamp(54px, 6vw, 76px);
  font-weight: 800;
  line-height: 1.06;
  letter-spacing: 0;
}

.hero-name-accent {
  color: #2563eb;
}

.hero-text h2 {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 8px;
  margin: 0 0 23px;
  color: #1f2f4a;
  font-size: clamp(17px, 2vw, 22px);
  font-weight: 600;
  line-height: 1.6;
  letter-spacing: 0;
}

.heading-divider {
  color: #656c7c;
  font-weight: 400;
}

.heading-accent {
  color: #3978c2;
}

.hero-description {
  max-width: 530px;
  margin: 0 0 23px;
  color: #53677f;
  font-size: 14px;
  line-height: 1.95;
}

/* =====================================
   AVAILABILITY STATUS
===================================== */

.hero-status {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 29px;
  padding: 10px 13px;
  border: 1px solid rgba(57, 120, 194, 0.18);
  border-radius: 8px;
  background: rgba(57, 120, 194, 0.06);
  color: #1f2f4a;
  font-size: 11px;
  line-height: 1.6;
}

.status-indicator {
  position: relative;
  width: 7px;
  height: 7px;
  flex-shrink: 0;
  border-radius: 50%;
  background: #3978c2;
  box-shadow: 0 0 10px rgba(57, 120, 194, 0.48);
}

.status-indicator::after {
  position: absolute;
  inset: -4px;
  border: 1px solid rgba(57, 120, 194, 0.45);
  border-radius: 50%;
  content: "";
  animation: status-pulse 2s ease-out infinite;
}

/* =====================================
   ACTION BUTTONS
===================================== */

.hero-buttons {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 32px;
}

.primary-btn,
.secondary-btn,
.download-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  min-height: 46px;
  border-radius: 9px;
  font-size: 12px;
  font-weight: 650;
  text-decoration: none;
  transition:
    transform 0.25s ease,
    background 0.25s ease,
    border-color 0.25s ease,
    box-shadow 0.25s ease;
}

.primary-btn {
  padding: 0 17px;
  border: 1px solid #3978c2;
  background: linear-gradient(110deg, #3978c2, #2563eb);
  color: #fff;
  box-shadow: 0 8px 25px rgba(37, 99, 235, 0.2);
}

.primary-btn:hover {
  transform: translateY(-3px);
  background: linear-gradient(110deg, #2563eb, #3978c2);
  box-shadow: 0 12px 28px rgba(37, 99, 235, 0.28);
}

.button-arrow {
  font-size: 17px;
}

.secondary-btn {
  padding: 0 15px;
  border: 1px solid rgba(255, 255, 255, 0.14);
  background: rgba(255, 255, 255, 0.035);
  color: #1f2f4a;
}

.secondary-btn svg,
.download-link svg {
  width: 17px;
  height: 17px;
}

.secondary-btn:hover {
  transform: translateY(-3px);
  border-color: rgba(57, 120, 194, 0.4);
  background: rgba(57, 120, 194, 0.07);
}

.download-link {
  min-height: 36px;
  color: #3978c2;
}

.download-link:hover {
  transform: translateY(-2px);
  color: #2563eb;
}

.primary-btn:focus-visible,
.secondary-btn:focus-visible,
.download-link:focus-visible,
.social-link:focus-visible,
.scroll-hint:focus-visible {
  outline: 2px solid #75a9e8;
  outline-offset: 4px;
}

/* =====================================
   SOCIAL LINKS
===================================== */

.hero-social-area {
  display: flex;
  flex-direction: column;
  gap: 13px;
}

.social-label {
  color: #737c8f;
  font-size: 9px;
  font-weight: 700;
  letter-spacing: 2px;
}

.social-links {
  display: flex;
  flex-wrap: wrap;
  gap: 19px;
}

.social-link {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  color: #a7adbb;
  font-size: 11px;
  font-weight: 550;
  text-decoration: none;
  transition: color 0.25s ease;
}

.social-link span:last-child {
  color: #8b75d9;
  transition: transform 0.25s ease;
}

.social-link:hover {
  color: #e4dcff;
}

.social-link:hover span:last-child {
  transform: translate(2px, -2px);
}

/* =====================================
   PROFILE VISUAL
===================================== */

.hero-image {
  display: flex;
  flex-direction: column;
  align-items: center;
  min-width: 0;
  animation: hero-enter 0.9s 0.12s ease both;
}

.profile-visual {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: min(100%, 430px);
  aspect-ratio: 1;
}

.profile-ring {
  position: absolute;
  border: 1px solid rgba(167, 139, 250, 0.15);
  border-radius: 50%;
  pointer-events: none;
}

.profile-ring-one {
  inset: 5%;
  animation: ring-rotate 32s linear infinite;
}

.profile-ring-two {
  inset: 12%;
  border-style: dashed;
  border-color: rgba(103, 232, 249, 0.16);
  animation: ring-rotate 45s linear infinite reverse;
}

.profile-orbit {
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
}

.orbit-one {
  top: 16%;
  right: 16%;
  width: 10px;
  height: 10px;
  background: #9fbe9f;
  box-shadow: 0 0 20px rgba(159, 190, 159, 0.75);
}

.orbit-two {
  bottom: 20%;
  left: 12%;
  width: 7px;
  height: 7px;
  background: #67e8f9;
  box-shadow: 0 0 16px rgba(103, 232, 249, 0.6);
}

/* Main profile card */
.profile-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 64%;
  min-height: 285px;
  padding: 24px 18px;
  border: 1px solid rgba(159, 190, 159, 0.25);
  border-radius: 24px;
  background:
    radial-gradient(
      circle at 50% 30%,
      rgba(92, 135, 98, 0.16),
      transparent 60%
    ),
    linear-gradient(
      145deg,
      rgba(27, 31, 49, 0.98),
      rgba(13, 17, 29, 0.98)
    );
  box-shadow:
    0 30px 75px rgba(0, 0, 0, 0.32),
    inset 0 1px 0 rgba(255, 255, 255, 0.06);
  backdrop-filter: blur(12px);
  animation: profile-float 5s ease-in-out infinite;
}

.profile-card-top {
  position: absolute;
  top: 17px;
  right: 15px;
  left: 15px;
  display: flex;
  align-items: center;
  gap: 7px;
  color: #858da0;
  font-size: 7px;
  font-weight: 700;
  letter-spacing: 1.3px;
}

.profile-card-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #9fbe9f;
}

.profile-card-menu {
  margin-left: auto;
  letter-spacing: 2px;
}

.profile-monogram {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 132px;
  height: 132px;
  margin-top: 14px;
  border: 1px solid rgba(159, 190, 159, 0.32);
  border-radius: 50%;
  background:
    radial-gradient(
      circle at 30% 20%,
      rgba(159, 190, 159, 0.22),
      transparent 60%
    ),
    rgba(92, 135, 98, 0.08);
  color: #eee9ff;
  font-size: 79px;
  font-weight: 800;
  line-height: 1;
  letter-spacing: -6px;
  box-shadow:
    0 0 0 9px rgba(92, 135, 98, 0.035),
    0 0 45px rgba(92, 135, 98, 0.1);
}

.monogram-period {
  color: #9fbe9f;
}

.profile-card-divider {
  width: 42px;
  height: 2px;
  margin: 22px 0 17px;
  border-radius: 3px;
  background: linear-gradient(90deg, #9fbe9f, #d5dfc6);
}

.profile-name {
  margin: 0 0 8px;
  color: #fff;
  font-size: 13px;
  font-weight: 750;
  letter-spacing: 3px;
}

.profile-role {
  margin: 0;
  color: #a7adbb;
  font-size: 8px;
  font-weight: 650;
  letter-spacing: 1.7px;
  text-align: center;
}

.profile-card-bottom {
  position: absolute;
  right: 15px;
  bottom: 17px;
  left: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  color: #737c8f;
  font-size: 7px;
  font-weight: 700;
  letter-spacing: 1.2px;
}

.profile-card-line {
  width: 15px;
  height: 1px;
  background: #8b75d9;
}

/* Floating Chips */
.floating-chip {
  position: absolute;
  z-index: 2;
  display: inline-flex;
  align-items: center;
  gap: 9px;
  padding: 12px 14px;
  border: 1px solid rgba(196, 181, 253, 0.2);
  border-radius: 11px;
  background: rgba(20, 24, 39, 0.93);
  color: #e1e4ed;
  font-size: 10px;
  font-weight: 600;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
  backdrop-filter: blur(12px);
}

.chip-top {
  top: 23%;
  right: -1%;
  animation: chip-float 5s 0.5s ease-in-out infinite;
}

.chip-bottom {
  bottom: 22%;
  left: -1%;
  animation: chip-float 5.5s 0.8s ease-in-out infinite reverse;
}

.chip-icon {
  color: #c4d5b6;
  font-size: 14px;
  font-weight: 800;
}

.chip-sparkle {
  color: #67e8f9;
  font-size: 14px;
}

.decorative-dot {
  position: absolute;
  width: 4px;
  height: 4px;
  border-radius: 50%;
  background: rgba(196, 181, 253, 0.7);
}

.decorative-dot-one {
  top: 30%;
  left: 14%;
}

.decorative-dot-two {
  right: 15%;
  bottom: 30%;
  background: rgba(103, 232, 249, 0.7);
}

/* Caption */
.hero-image-caption {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  margin-top: -3px;
  color: #737c8f;
  font-size: 8px;
  font-weight: 700;
  letter-spacing: 2.2px;
}

.caption-line {
  width: 23px;
  height: 1px;
  background: rgba(167, 139, 250, 0.45);
}

/* =====================================
   SCROLL HINT
===================================== */

.scroll-hint {
  position: absolute;
  right: 32px;
  bottom: 25px;
  display: flex;
  align-items: center;
  gap: 12px;
  color: #737c8f;
  font-size: 8px;
  font-weight: 700;
  letter-spacing: 1.7px;
  text-decoration: none;
}

.scroll-hint-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 27px;
  height: 27px;
  border: 1px solid rgba(167, 139, 250, 0.25);
  border-radius: 50%;
  color: #c4d5b6;
  font-size: 14px;
  animation: scroll-bounce 1.8s ease-in-out infinite;
}

/* =====================================
   ANIMATIONS
===================================== */

@keyframes hero-enter {
  from {
    opacity: 0;
    transform: translateY(18px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes profile-float {
  0%,
  100% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(-8px);
  }
}

@keyframes chip-float {
  0%,
  100% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(-7px);
  }
}

@keyframes ring-rotate {
  to {
    transform: rotate(360deg);
  }
}

@keyframes status-pulse {
  0% {
    transform: scale(0.8);
    opacity: 0.8;
  }

  100% {
    transform: scale(1.9);
    opacity: 0;
  }
}

@keyframes scroll-bounce {
  0%,
  100% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(4px);
  }
}

/* =====================================
   TABLET
===================================== */

@media (max-width: 950px) {
  .hero {
    padding: 90px 0 80px;
  }

  .hero-container {
    grid-template-columns: minmax(0, 1fr) minmax(0, 0.8fr);
    gap: 25px;
    width: calc(100% - 48px);
  }

  .hero-text h1 {
    font-size: clamp(48px, 6vw, 64px);
  }

  .hero-buttons {
    gap: 10px;
  }

  .profile-card {
    width: 70%;
    min-height: 260px;
  }

  .profile-monogram {
    width: 110px;
    height: 110px;
    font-size: 68px;
  }

  .floating-chip {
    padding: 10px;
    font-size: 9px;
  }
}

/* =====================================
   MOBILE
===================================== */

@media (max-width: 680px) {
  .hero {
    min-height: auto;
    padding: 76px 0 82px;
  }

  .hero-container {
    grid-template-columns: 1fr;
    gap: 45px;
    width: calc(100% - 38px);
  }

  .hero-text h1 {
    font-size: clamp(48px, 12vw, 65px);
    letter-spacing: -2.5px;
  }

  .hero-text h2 {
    font-size: 17px;
  }

  .hero-description {
    font-size: 13px;
  }

  .hero-status {
    align-items: flex-start;
    font-size: 10px;
  }

  .hero-buttons {
    align-items: stretch;
    gap: 10px;
  }

  .primary-btn,
  .secondary-btn {
    min-height: 44px;
  }

  .download-link {
    padding: 0 5px;
  }

  .social-links {
    gap: 14px;
  }

  .social-link {
    font-size: 10px;
  }

  .hero-image {
    width: 100%;
  }

  .profile-visual {
    width: min(100%, 365px);
  }

  .profile-card {
    width: 65%;
    min-height: 255px;
  }

  .profile-monogram {
    width: 112px;
    height: 112px;
    font-size: 69px;
  }

  .chip-top {
    right: 0;
  }

  .chip-bottom {
    left: 0;
  }

  .scroll-hint {
    right: 19px;
    bottom: 17px;
  }
}

@media (max-width: 380px) {
  .hero-container {
    width: calc(100% - 30px);
  }

  .hero-buttons {
    gap: 8px;
  }

  .primary-btn,
  .secondary-btn {
    padding: 0 11px;
    font-size: 11px;
  }

  .download-link {
    font-size: 11px;
  }

  .profile-card {
    width: 70%;
    min-height: 235px;
  }

  .profile-monogram {
    width: 95px;
    height: 95px;
    font-size: 59px;
  }

  .floating-chip {
    padding: 9px;
    font-size: 8px;
  }
}

/* =====================================
   REDUCED MOTION
===================================== */

@media (prefers-reduced-motion: reduce) {
  .hero *,
  .hero *::before,
  .hero *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
</style>
```
