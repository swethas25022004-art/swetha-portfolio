
<template>
  <section id="certificates" class="certificates-section">
    <!-- Animated background shapes -->
    <div class="cert-bg-shapes" aria-hidden="true">
      <span class="bg-shape shape-one"></span>
      <span class="bg-shape shape-two"></span>
      <span class="bg-shape shape-three"></span>
      <span class="bg-shape shape-four"></span>
      <span class="bg-shape shape-five"></span>
    </div>

    <div class="certificates-container">
      <!-- Heading -->
      <header class="section-title reveal-heading">
        <p class="section-eyebrow">
          <span class="eyebrow-line"></span>
          ACHIEVEMENTS & LEARNING
        </p>

        <h2>My <span>Certificates.</span></h2>

        <p class="section-description">
          A collection of my certifications, professional experience
          and continuous learning journey.
        </p>

        <div class="certificate-summary">
          <div class="summary-item">
            <strong>14</strong>
            <span>Certificates</span>
          </div>

          <div class="summary-divider"></div>

          <div class="summary-item">
            <strong>01</strong>
            <span>Current Experience</span>
          </div>
        </div>
      </header>

      <!-- One continuous grid: no separate year sections -->
      <div class="certificates-grid">
        <article
          v-for="(certificate, index) in certificates"
          :key="certificate.title"
          class="certificate-card"
          :class="{ 'current-card': certificate.inProgress }"
          :style="{ '--card-delay': `${(index % 3) * 100}ms` }"
        >
          <div class="card-top-row">
            <span class="certificate-number">
              {{ String(index + 1).padStart(2, '0') }}
            </span>

            <span
              v-if="certificate.inProgress"
              class="status-badge"
            >
              <span class="status-dot"></span>
              IN PROGRESS
            </span>

            <span v-else class="certificate-year">
              {{ certificate.year || 'ADDITIONAL' }}
            </span>
          </div>

          <div class="certificate-card-content">
            <p class="certificate-label">
              {{ certificate.category }}
            </p>

            <h3>{{ certificate.title }}</h3>

            <p class="certificate-description">
              {{ certificate.description }}
            </p>
          </div>

          <div class="card-bottom-row">
            <a
              v-if="certificate.file"
              :href="'/certificates/' + certificate.file"
              target="_blank"
              rel="noopener noreferrer"
              class="certificate-link"
            >
              <span>View Certificate</span>
              <span class="link-arrow" aria-hidden="true">↗</span>
            </a>

            <span v-else class="certificate-pending">
              Certificate pending
            </span>

            <span class="card-index-mark" aria-hidden="true">
              {{ certificate.inProgress ? '↗' : '✦' }}
            </span>
          </div>
        </article>
      </div>

      <div class="certificates-footer-note reveal-heading">
        <span class="footer-note-icon">✦</span>
        <p>Always learning. Always building. Always growing.</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, nextTick } from 'vue'

const certificates = [
  // Current experience — always first
  {
    title: 'Full Stack Developer Intern',
    category: 'CURRENT INTERNSHIP',
    description: 'Appspire Solutions · Hyderabad',
    year: 'CURRENT',
    file: null,
    inProgress: true
  },

  // 2026
  {
    title: 'Data Analytics',
    category: 'DATA ANALYTICS',
    description: 'Data Analytics Certification',
    year: 2026,
    file: 'data-analytics.pdf'
  },
  
  {
    title: 'Ethereum Suspicious Transactions',
    category: 'MCA FINAL YEAR PROJECT',
    description: 'Finding Suspicious Transactions in Ethereum Network',
    year: '2026',
    file: 'ethereum-suspicious-transactions-project.pdf'
  },

  // 2025
  {
    title: 'Machine Learning',
    category: 'NPTEL',
    description: 'NPTEL Machine Learning Certification',
    year: '2025',
    file: 'nptel-machine-learning-2025.pdf'
  },
  {
    title: 'UI/UX Internship',
    category: 'UI / UX DESIGN',
    description: 'UI/UX Design Internship',
    year: '2025',
    file: 'ui-ux-internship-2025.pdf'
  },

  // 2023
  {
    title: 'IoT Foundation Course',
    category: 'NASSCOM',
    description: 'IoT Foundation Course — SFI202',
    year: '2023',
    file: 'IoT_Foundation_2023.pdf'
  },
  {
    title: 'TCS NQT',
    category: 'TCS',
    description: 'TCS National Qualifier Test',
    year: '2023',
    file: 'tcs-nqt-2023.pdf'
  },
  {
    title: 'Project Certificate',
    category: 'ACADEMIC PROJECT',
    description: 'Project Certificate — 2023',
    year: '2023',
    file: 'project-certificate-2023.jpg'
  },

  // 2022
  {
    title: 'English Typing — Higher Grade',
    category: 'TYPING',
    description: 'English Typing Higher Grade',
    year: '2022',
    file: 'english-typing-higher-grade-2022.jpg'
  },
  {
    title: 'Web Development Internship',
    category: 'WEB DEVELOPMENT',
    description: 'Web Development Internship',
    year: '2022',
    file: 'web-development-internship-2022.jpg'
  },

  // Additional certificates — year not confirmed
 
  {
    title: 'Power BI Certification',
    category: 'DATA & ANALYTICS',
    description: 'Power BI and Data Visualization',
    year: null,
    file: 'power-bi-certification.pdf'
  },

  {
    title: 'Interpersonal Skills',
    category: 'IBM',
    description: 'IBM Interpersonal Skills Certification',
    year: null,
    file: 'ibm-interpersonal-skills.pdf'
  },
  {
    title: 'NASSCOM–IBM Certification',
    category: 'NASSCOM / IBM',
    description: 'NASSCOM–IBM certification document',
    year: null,
    file: 'nasscom-ibm-certification.png'
  },
  {
    title: 'Human Rights Day E-Quiz',
    category: 'E-QUIZ',
    description: 'Human Rights Day E-Quiz certificate',
    year: null,
    file: 'human-rights-day-equiz.pdf'
  }
]

const observer = ref(null)

onMounted(async () => {
  await nextTick()

  const section = document.querySelector('#certificates')
  if (!section) return

  const elements = section.querySelectorAll(
    '.reveal-heading, .certificate-card'
  )

  const reduceMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
  ).matches

  if (
    reduceMotion ||
    !('IntersectionObserver' in window)
  ) {
    elements.forEach(element => element.classList.add('is-visible'))
    return
  }

  observer.value = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible')
          observer.value?.unobserve(entry.target)
        }
      })
    },
    {
      threshold: 0.08,
      rootMargin: '0px 0px -25px 0px'
    }
  )

  elements.forEach(element => observer.value.observe(element))
})

onBeforeUnmount(() => {
  observer.value?.disconnect()
})
</script>

<style scoped>
.certificates-section {
  --cert-bg: #edf5ff;
  --cert-card: #ffffff;
  --cert-card-hover: #eef6ff;
  --cert-text: #14283f;
  --cert-muted: #53677f;
  --cert-accent: #3978c2;
  --cert-border: rgba(59, 110, 175, 0.15);

  position: relative;
  isolation: isolate;
  overflow: hidden;
  padding: 100px 24px 80px;
  color: var(--cert-text);
  background:
    radial-gradient(
      ellipse at 10% 10%,
      rgba(57, 120, 194, 0.1),
      transparent 35%
    ),
    radial-gradient(
      ellipse at 90% 65%,
      rgba(117, 169, 232, 0.12),
      transparent 32%
    ),
    var(--cert-bg);
}

.certificates-container {
  position: relative;
  z-index: 2;
  width: min(1180px, 100%);
  margin: 0 auto;
}

/* Floating background boxes */
.cert-bg-shapes {
  position: absolute;
  inset: 0;
  z-index: -1;
  overflow: hidden;
  pointer-events: none;
}

.bg-shape {
  position: absolute;
  display: block;
  border: 1px solid rgba(160, 180, 255, 0.15);
  border-radius: 14px;
  background: linear-gradient(
    135deg,
    rgba(120, 145, 255, 0.08),
    rgba(30, 210, 190, 0.035)
  );
  animation: floatBox 12s ease-in-out infinite;
}

.shape-one {
  width: 110px;
  height: 110px;
  top: 10%;
  left: 4%;
}

.shape-two {
  width: 65px;
  height: 65px;
  top: 25%;
  right: 8%;
  animation-delay: -3s;
}

.shape-three {
  width: 145px;
  height: 145px;
  top: 55%;
  left: -55px;
  animation-delay: -5s;
}

.shape-four {
  width: 90px;
  height: 90px;
  top: 72%;
  right: 6%;
  animation-delay: -7s;
}

.shape-five {
  width: 45px;
  height: 45px;
  top: 42%;
  left: 78%;
  animation-delay: -2s;
}

@keyframes floatBox {
  0%, 100% {
    translate: 0 0;
    rotate: 0deg;
  }
  50% {
    translate: 0 -22px;
    rotate: 8deg;
  }
}

/* Section heading */
.section-title {
  max-width: 720px;
  margin: 0 auto 58px;
  text-align: center;
}

.section-eyebrow {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 11px;
  margin: 0 0 18px;
  color: #c4d5b6;
  font-size: 0.76rem;
  font-weight: 750;
  letter-spacing: 0.19em;
}

.eyebrow-line {
  width: 30px;
  height: 2px;
  background: #9fbe9f;
}

.section-title h2 {
  margin: 0;
  color: #f8faff;
  font-size: clamp(2.4rem, 5vw, 4rem);
  line-height: 1.15;
  letter-spacing: -0.045em;
}

.section-title h2 span {
  color: #9fbe9f;
  background: linear-gradient(100deg, #c4d5b6, #9fbe9f);
  -webkit-background-clip: text;
  background-clip: text;
  -webkit-text-fill-color: transparent;
}

.section-description {
  max-width: 540px;
  margin: 20px auto 0;
  color: var(--cert-muted);
  font-size: 1rem;
  line-height: 1.8;
}

.certificate-summary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 27px;
  margin-top: 30px;
  padding: 16px 27px;
  border: 1px solid var(--cert-border);
  border-radius: 18px;
  background: rgba(17, 30, 49, 0.82);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.16);
  backdrop-filter: blur(12px);
}

.summary-item {
  display: flex;
  flex-direction: column;
  gap: 4px;
  text-align: left;
}

.summary-item strong {
  color: #f6f8ff;
  font-size: 1.35rem;
}

.summary-item span {
  color: #c0ccdf;
  font-size: 0.75rem;
}

.summary-divider {
  width: 1px;
  height: 34px;
  background: var(--cert-border);
}

/* Continuous three-column grid */
.certificates-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 22px;
  align-items: stretch;
}

/* Certificate cards */
.certificate-card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  min-height: 270px;
  padding: 24px;
  overflow: hidden;
  border: 1px solid var(--cert-border);
  border-radius: 19px;
  background: linear-gradient(
    145deg,
    rgba(25, 42, 66, 0.98),
    rgba(14, 27, 45, 0.98)
  );
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
  opacity: 0;
  transform: translateY(25px);
  transition:
    opacity 650ms ease,
    transform 650ms cubic-bezier(0.22, 1, 0.36, 1),
    border-color 300ms ease,
    box-shadow 300ms ease,
    background 300ms ease;
  transition-delay: var(--card-delay, 0ms);
}

.certificate-card::before {
  position: absolute;
  top: 0;
  left: 20px;
  right: 20px;
  height: 2px;
  content: '';
  background: linear-gradient(
    90deg,
    transparent,
    #94a6ff,
    #70dfd5,
    transparent
  );
  opacity: 0;
  transition: opacity 300ms ease;
}

.certificate-card::after {
  position: absolute;
  top: -70px;
  right: -70px;
  width: 140px;
  height: 140px;
  content: '';
  border: 1px solid rgba(150, 175, 255, 0.1);
  border-radius: 24px;
  transform: rotate(25deg);
  pointer-events: none;
}

.certificate-card.is-visible {
  opacity: 1;
  transform: translateY(0);
}

.certificate-card.is-visible:hover {
  transform: translateY(-7px);
  border-color: rgba(155, 175, 255, 0.52);
  background: var(--cert-card-hover);
  box-shadow: 0 23px 45px rgba(0, 0, 0, 0.27);
}

.certificate-card:hover::before {
  opacity: 1;
}

.current-card {
  border-color: rgba(103, 220, 181, 0.36);
  background: linear-gradient(
    145deg,
    rgba(18, 57, 59, 0.94),
    rgba(15, 33, 49, 0.98)
  );
}

.current-card::before {
  background: linear-gradient(
    90deg,
    transparent,
    #62dfb2,
    #80e7df,
    transparent
  );
}

.card-top-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 25px;
}

.certificate-number {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  width: 40px;
  height: 40px;
  border: 1px solid rgba(164, 181, 255, 0.25);
  border-radius: 12px;
  color: #d0d8ff;
  background: rgba(140, 160, 255, 0.12);
  font-size: 0.8rem;
  font-weight: 750;
  transition: transform 300ms ease, background 300ms ease;
}

.certificate-card:hover .certificate-number {
  transform: rotate(-5deg) scale(1.06);
  background: rgba(140, 160, 255, 0.22);
}

.certificate-year {
  padding: 7px 10px;
  border: 1px solid rgba(164, 181, 255, 0.2);
  border-radius: 20px;
  color: #d0d8ff;
  background: rgba(140, 160, 255, 0.09);
  font-size: 0.68rem;
  font-weight: 750;
  letter-spacing: 0.04em;
  text-align: center;
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 7px 10px;
  border: 1px solid rgba(103, 220, 181, 0.3);
  border-radius: 20px;
  color: #a1f4d4;
  background: rgba(53, 190, 140, 0.12);
  font-size: 0.62rem;
  font-weight: 750;
  letter-spacing: 0.03em;
}

.status-dot {
  width: 7px;
  height: 7px;
  flex-shrink: 0;
  border-radius: 50%;
  background: #64e2ae;
  box-shadow: 0 0 12px rgba(100, 226, 174, 0.7);
  animation: statusPulse 2s ease-in-out infinite;
}

@keyframes statusPulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.45; }
}

.certificate-card-content {
  flex: 1;
}

.certificate-label {
  margin: 0 0 10px;
  color: #b0bdff;
  font-size: 0.67rem;
  font-weight: 750;
  letter-spacing: 0.11em;
  line-height: 1.6;
}

.certificate-card h3 {
  margin: 0;
  color: #f5f7ff;
  font-size: 1.1rem;
  font-weight: 700;
  line-height: 1.55;
  overflow-wrap: anywhere;
}

.certificate-description {
  margin: 10px 0 0;
  color: #c7d2e3;
  font-size: 0.87rem;
  line-height: 1.75;
  overflow-wrap: anywhere;
}

.card-bottom-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-top: 24px;
  padding-top: 17px;
  border-top: 1px solid rgba(173, 190, 255, 0.15);
}

.certificate-link {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  color: #c5ceff;
  font-size: 0.84rem;
  font-weight: 700;
  text-decoration: none;
  transition: color 250ms ease, gap 250ms ease;
}

.certificate-link:hover {
  gap: 14px;
  color: #8ee8de;
}

.link-arrow {
  font-size: 1.1rem;
  transition: transform 250ms ease;
}

.certificate-link:hover .link-arrow {
  transform: translate(2px, -2px);
}

.certificate-pending {
  color: #a4ead0;
  font-size: 0.8rem;
  font-weight: 650;
}

.card-index-mark {
  color: #aab8d5;
  font-size: 1.1rem;
}

/* Footer */
.certificates-footer-note {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  margin-top: 38px;
  padding: 25px 18px;
  border: 1px solid var(--cert-border);
  border-radius: 16px;
  background: rgba(17, 30, 49, 0.75);
  text-align: center;
}

.footer-note-icon {
  color: #b2beff;
}

.certificates-footer-note p {
  margin: 0;
  color: #e0e7f4;
  font-size: 0.92rem;
}

/* Scroll reveal */
.reveal-heading {
  opacity: 0;
  transform: translateY(22px);
  transition: opacity 650ms ease, transform 650ms ease;
}

.reveal-heading.is-visible {
  opacity: 1;
  transform: translateY(0);
}

/* Tablet */
@media (max-width: 950px) {
  .certificates-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .certificates-section {
    padding: 85px 22px 70px;
  }
}

/* Mobile */
@media (max-width: 600px) {
  .certificates-section {
    padding: 70px 16px 55px;
  }

  .section-title {
    margin-bottom: 45px;
  }

  .section-eyebrow {
    font-size: 0.66rem;
    letter-spacing: 0.12em;
  }

  .certificate-summary {
    gap: 18px;
    padding: 14px 18px;
  }

  .certificates-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .certificate-card {
    min-height: 235px;
    padding: 22px;
  }

  .shape-one {
    left: -45px;
  }

  .shape-two {
    right: -20px;
  }

  .certificates-footer-note {
    padding: 20px 14px;
  }
}

/* Accessibility: respect reduced-motion preference */
@media (prefers-reduced-motion: reduce) {
  .bg-shape,
  .status-dot {
    animation: none !important;
  }

  .certificate-card,
  .reveal-heading,
  .certificate-number,
  .certificate-link,
  .link-arrow {
    transition: none !important;
  }

  .certificate-card,
  .reveal-heading {
    opacity: 1;
    transform: none;
  }
}
</style>