```vue
<template>
  <section id="contact" class="contact-section">
    <div class="contact-orb contact-orb-one"></div>
    <div class="contact-orb contact-orb-two"></div>

    <div class="contact-container">
      <!-- Section Heading -->
      <header class="section-title reveal">
        <span class="contact-eyebrow">
          <span class="eyebrow-dot"></span>
          GET IN TOUCH
        </span>

        <h2>
          Let's build something
          <span class="gradient-text">together.</span>
        </h2>

        <p class="contact-description">
          I'm open to Full Stack Developer opportunities,
          internships, and collaborations where I can contribute
          my skills and build meaningful digital experiences.
        </p>
      </header>

      <!-- Contact Content -->
      <div class="contact-content">
        <!-- Left Introduction -->
        <div class="contact-intro reveal">
          <div class="contact-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none">
              <path
                d="M22 2 11 13"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
              />
              <path
                d="m22 2-7 20-4-9-9-4 20-7Z"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </div>

          <span class="intro-label">LET'S CONNECT</span>

          <h3>Have an opportunity in mind?</h3>

          <p>
            Whether it's a job opportunity, a development project,
            or a chance to collaborate, I'd be happy to connect
            and hear from you.
          </p>

          <a
            href="mailto:swethas25022004@gmail.com"
            class="email-link"
          >
            <span class="email-symbol" aria-hidden="true">✉</span>
            <span class="email-address">
              swethas25022004@gmail.com
            </span>
            <span class="email-arrow" aria-hidden="true">↗</span>
          </a>

          <div class="contact-note">
            <span class="note-line"></span>
            <span>Usually happy to connect and discuss new ideas.</span>
          </div>
        </div>

        <!-- Contact Cards -->
        <div class="contact-links">
          <!-- Email -->
          <a
            href="mailto:swethas25022004@gmail.com"
            class="contact-card reveal"
            aria-label="Send an email to Swetha"
          >
            <div class="card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none">
                <rect
                  x="3" y="5" width="18" height="14" rx="3"
                  stroke="currentColor" stroke-width="1.6"
                />
                <path
                  d="m4 7 8 6 8-6"
                  stroke="currentColor" stroke-width="1.6"
                  stroke-linecap="round" stroke-linejoin="round"
                />
              </svg>
            </div>

            <div class="card-text">
              <span>EMAIL ME</span>
              <h4>Let's talk</h4>
              <p>Reach out directly by email.</p>
            </div>

            <span class="card-arrow" aria-hidden="true">↗</span>
          </a>

          <!-- LinkedIn -->
          <a
            href="https://www.linkedin.com/in/swetha-s2502"
            target="_blank"
            rel="noopener noreferrer"
            class="contact-card reveal"
            aria-label="Visit Swetha's LinkedIn profile"
          >
            <div class="card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none">
                <rect
                  x="3" y="3" width="18" height="18" rx="3"
                  stroke="currentColor" stroke-width="1.5"
                />
                <path
                  d="M7 10v7M7 7.5v.1M11 17v-7m0 3a3 3 0 0 1 6 0v4"
                  stroke="currentColor" stroke-width="1.7"
                  stroke-linecap="round"
                />
              </svg>
            </div>

            <div class="card-text">
              <span>LINKEDIN</span>
              <h4>Let's connect</h4>
              <p>Explore my professional profile.</p>
            </div>

            <span class="card-arrow" aria-hidden="true">↗</span>
          </a>

          <!-- GitHub -->
          <a
            href="https://github.com/SwethaAppspire"
            target="_blank"
            rel="noopener noreferrer"
            class="contact-card reveal"
            aria-label="Visit Swetha's GitHub profile"
          >
            <div class="card-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none">
                <path
                  d="M9 19c-4.5 1.4-4.5-2.5-6-3
                  M15 21v-3.9a3.4 3.4 0 0 0-.9-2.6
                  c3-.3 6.2-1.5 6.2-6.7
                  a5.2 5.2 0 0 0-1.4-3.6
                  4.8 4.8 0 0 0-.1-3.6
                  S16.6.3 15 2.2
                  a13.2 13.2 0 0 0-7 0
                  C6.4.3 4.2.6 4.2.6
                  a4.8 4.8 0 0 0-.1 3.6
                  5.2 5.2 0 0 0-1.4 3.6
                  c0 5.2 3.2 6.4 6.2 6.7
                  A3.4 3.4 0 0 0 8 17.1V21"
                  stroke="currentColor" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"
                />
              </svg>
            </div>

            <div class="card-text">
              <span>GITHUB</span>
              <h4>Explore my work</h4>
              <p>Discover my projects and code.</p>
            </div>

            <span class="card-arrow" aria-hidden="true">↗</span>
          </a>
        </div>
      </div>

      <!-- Bottom Call to Action -->
      <div class="contact-bottom reveal">
        <div class="availability">
          <span class="availability-dot"></span>

          <div>
            <strong>OPEN TO OPPORTUNITIES</strong>
            <span>Let's create something meaningful.</span>
          </div>
        </div>

        <a
          href="mailto:swethas25022004@gmail.com?subject=Portfolio%20Enquiry"
          class="contact-cta"
        >
          Start a conversation
          <span aria-hidden="true">↗</span>
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'

let revealObserver

onMounted(() => {
  const elements = document.querySelectorAll(
    '#contact .reveal'
  )

  if (
    !('IntersectionObserver' in window) ||
    window.matchMedia('(prefers-reduced-motion: reduce)').matches
  ) {
    elements.forEach((element) => {
      element.classList.add('is-visible')
    })
    return
  }

  revealObserver = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible')
          observer.unobserve(entry.target)
        }
      })
    },
    {
      threshold: 0.12,
      rootMargin: '0px 0px -35px 0px'
    }
  )

  elements.forEach((element, index) => {
    element.style.setProperty(
      '--reveal-delay',
      `${Math.min(index * 90, 360)}ms`
    )

    revealObserver.observe(element)
  })
})

onUnmounted(() => {
  revealObserver?.disconnect()
})
</script>

<style scoped>
/* =====================================
   CONTACT SECTION
===================================== */

.contact-section {
  position: relative;
  isolation: isolate;
  overflow: hidden;
  padding: 100px 0 38px;
  background: linear-gradient(135deg, #ffffff 0%, #edf5ff 100%);
  color: #14283f;
  font-family: inherit;
}

.contact-container {
  position: relative;
  z-index: 1;
  width: min(1120px, calc(100% - 64px));
  margin: 0 auto;
}

.contact-orb {
  position: absolute;
  z-index: -1;
  width: 340px;
  height: 340px;
  border-radius: 50%;
  filter: blur(105px);
  pointer-events: none;
}

.contact-orb-one {
  top: 60px;
  left: -210px;
  background: rgba(139, 92, 246, 0.13);
}

.contact-orb-two {
  right: -210px;
  bottom: 20px;
  background: rgba(56, 189, 248, 0.07);
}

/* =====================================
   SECTION TITLE
===================================== */

.section-title {
  max-width: 760px;
  margin: 0 auto 65px;
  text-align: center;
}

.contact-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 22px;
  color: #3978c2;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2.5px;
}

.eyebrow-dot,
.availability-dot {
  flex-shrink: 0;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #3978c2;
  box-shadow: 0 0 13px rgba(57, 120, 194, 0.4);
}

.section-title h2 {
  margin: 0 0 22px;
  color: #14283f;
  font-size: clamp(34px, 4.5vw, 49px);
  font-weight: 750;
  line-height: 1.2;
  letter-spacing: -1.6px;
}

.gradient-text {
  color: #c4d5b6;
  background: linear-gradient(100deg, #c4d5b6, #9fbe9f 55%, #eaf0df);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.contact-description {
  max-width: 620px;
  margin: 0 auto;
  color: #a7adbb;
  font-size: 14px;
  line-height: 1.9;
}

/* =====================================
   MAIN CONTENT
===================================== */

.contact-content {
  display: grid;
  grid-template-columns: 0.9fr 1.1fr;
  align-items: center;
  gap: 70px;
}

/* =====================================
   INTRODUCTION
===================================== */

.contact-intro {
  max-width: 430px;
}

.contact-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 58px;
  height: 58px;
  margin-bottom: 24px;
  border: 1px solid rgba(159, 190, 159, 0.3);
  border-radius: 17px;
  background: rgba(80, 144, 220, 0.12);
  color: #c4d5b6;
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.14);
}

.contact-icon svg {
  width: 27px;
  height: 27px;
}

.intro-label {
  display: block;
  margin-bottom: 12px;
  color: #9fbe9f;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 2px;
}

.contact-intro h3 {
  margin: 0 0 17px;
  color: #fff;
  font-size: clamp(25px, 2.5vw, 30px);
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: -0.7px;
}

.contact-intro > p {
  margin: 0 0 25px;
  color: #a7adbb;
  font-size: 13px;
  line-height: 1.9;
}

.email-link {
  display: inline-flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
  max-width: 100%;
  color: #d4c6ff;
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
  overflow-wrap: anywhere;
  transition: color 0.25s ease;
}

.email-link:hover {
  color: #fff;
}

.email-link:focus-visible,
.contact-card:focus-visible,
.contact-cta:focus-visible {
  outline: 2px solid #c4d5b6;
  outline-offset: 5px;
}

.email-symbol {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 31px;
  height: 31px;
  flex-shrink: 0;
  border: 1px solid rgba(159, 190, 159, 0.25);
  border-radius: 50%;
  background: rgba(92, 135, 98, 0.08);
}

.email-arrow {
  font-size: 17px;
}

.contact-note {
  display: flex;
  align-items: center;
  gap: 11px;
  margin-top: 27px;
  color: #858da0;
  font-size: 11px;
  line-height: 1.7;
}

.note-line {
  width: 24px;
  height: 1px;
  flex-shrink: 0;
  background: #9fbe9f;
}

/* =====================================
   CONTACT CARDS
===================================== */

.contact-links {
  display: flex;
  flex-direction: column;
  gap: 13px;
}

.contact-card {
  display: flex;
  align-items: center;
  gap: 17px;
  min-width: 0;
  padding: 21px;
  border: 1px solid rgba(255, 255, 255, 0.09);
  border-radius: 15px;
  background: rgba(255, 255, 255, 0.025);
  text-decoration: none;
  backdrop-filter: blur(8px);
  transition:
    transform 0.25s ease,
    border-color 0.25s ease,
    background 0.25s ease,
    box-shadow 0.25s ease;
}

.contact-card:hover {
  transform: translateY(-3px);
  border-color: rgba(159, 190, 159, 0.4);
  background: rgba(92, 135, 98, 0.07);
  box-shadow: 0 14px 35px rgba(0, 0, 0, 0.15);
}

.card-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 46px;
  height: 46px;
  flex-shrink: 0;
  border: 1px solid rgba(159, 190, 159, 0.2);
  border-radius: 13px;
  background: rgba(92, 135, 98, 0.1);
  color: #c4d5b6;
  transition:
    color 0.25s ease,
    background 0.25s ease;
}

.contact-card:hover .card-icon {
  background: rgba(159, 190, 159, 0.17);
  color: #edf2e6;
}

.card-icon svg {
  width: 23px;
  height: 23px;
}

.card-text {
  flex: 1;
  min-width: 0;
}

.card-text > span {
  display: block;
  margin-bottom: 6px;
  color: #b8a2ff;
  font-size: 9px;
  font-weight: 700;
  letter-spacing: 1.6px;
}

.card-text h4 {
  margin: 0 0 5px;
  color: #f9fafb;
  font-size: 15px;
  font-weight: 650;
}

.card-text p {
  margin: 0;
  color: #a7adbb;
  font-size: 11px;
  line-height: 1.7;
}

.card-arrow {
  flex-shrink: 0;
  color: #c4d5b6;
  font-size: 19px;
  transition: transform 0.25s ease;
}

.contact-card:hover .card-arrow {
  transform: translate(3px, -3px);
}

/* =====================================
   BOTTOM CTA
===================================== */

.contact-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 22px;
  margin-top: 70px;
  padding: 25px 0;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.availability {
  display: flex;
  align-items: center;
  gap: 13px;
}

.availability > div {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.availability strong {
  color: #d8dbe5;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 1.4px;
}

.availability > div > span {
  color: #9299a8;
  font-size: 11px;
}

.contact-cta {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  padding: 13px 18px;
  border: 1px solid rgba(167, 139, 250, 0.35);
  border-radius: 9px;
  background: rgba(139, 92, 246, 0.1);
  color: #e9ddff;
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
  transition:
    background 0.25s ease,
    border-color 0.25s ease,
    transform 0.25s ease;
}

.contact-cta:hover {
  transform: translateY(-2px);
  border-color: #9fbe9f;
  background: rgba(92, 135, 98, 0.2);
}

.contact-cta span {
  font-size: 17px;
}

/* =====================================
   SCROLL REVEAL
===================================== */

.reveal {
  opacity: 0;
  transform: translateY(20px);
  transition:
    opacity 0.65s ease var(--reveal-delay, 0ms),
    transform 0.65s ease var(--reveal-delay, 0ms);
}

.reveal.is-visible {
  opacity: 1;
  transform: translateY(0);
}

/* =====================================
   TABLET
===================================== */

@media (max-width: 850px) {
  .contact-content {
    grid-template-columns: 1fr;
    gap: 42px;
    max-width: 620px;
    margin: 0 auto;
  }

  .contact-intro {
    max-width: 100%;
  }

  .section-title {
    margin-bottom: 48px;
  }

  .contact-bottom {
    margin-top: 50px;
  }
}

/* =====================================
   MOBILE
===================================== */

@media (max-width: 600px) {
  .contact-section {
    padding: 72px 0 25px;
  }

  .contact-container {
    width: calc(100% - 36px);
  }

  .section-title {
    margin-bottom: 38px;
    text-align: left;
  }

  .contact-eyebrow {
    margin-bottom: 17px;
    font-size: 10px;
  }

  .section-title h2 {
    font-size: clamp(32px, 8vw, 40px);
    letter-spacing: -1px;
  }

  .contact-description {
    font-size: 13px;
  }

  .contact-content {
    gap: 34px;
  }

  .contact-intro h3 {
    font-size: 25px;
  }

  .contact-card {
    gap: 12px;
    padding: 15px;
  }

  .card-icon {
    width: 40px;
    height: 40px;
  }

  .card-text h4 {
    font-size: 14px;
  }

  .card-text p {
    font-size: 10px;
  }

  .contact-bottom {
    align-items: flex-start;
    flex-direction: column;
    margin-top: 42px;
    padding-top: 23px;
  }

  .contact-cta {
    width: 100%;
  }
}

/* =====================================
   REDUCED MOTION
===================================== */

@media (prefers-reduced-motion: reduce) {
  .contact-section *,
  .contact-section *::before,
  .contact-section *::after {
    scroll-behavior: auto !important;
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }

  .reveal {
    opacity: 1;
    transform: none;
  }
}
</style>
```
