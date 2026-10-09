```vue
<template>
  <section id="projects" class="projects-section">
    <!-- Animated background -->
    <div class="ambient-glow glow-left"></div>
    <div class="ambient-glow glow-right"></div>
    <div class="ambient-glow glow-bottom"></div>
    <div class="background-grid"></div>

    <div class="particles" aria-hidden="true">
      <span
        v-for="particle in particles"
        :key="particle.id"
        class="particle"
        :style="{
          left: particle.left,
          top: particle.top,
          '--duration': particle.duration,
          '--delay': particle.delay,
          '--size': particle.size
        }"
      ></span>
    </div>

    <div class="projects-container">
      <!-- PROJECT COLLECTION -->
      <div v-if="!selectedProject" class="projects-view">
        <header class="section-heading">
          <span class="eyebrow">
            <span class="status-dot"></span>
            SELECTED WORK
          </span>

          <h2>
            Turning ideas into
            <span class="gradient-text">digital experiences.</span>
          </h2>

          <p>
            Academic work and personal development projects that reflect
            my journey in web development, programming and data analysis.
          </p>

          <div class="heading-meta">
            <span>03 PROJECTS</span>
            <span class="meta-divider"></span>
            <span>DEVELOPMENT PORTFOLIO</span>
          </div>
        </header>

        <div class="projects-grid">
          <article
            v-for="(project, index) in projects"
            :key="project.id"
            class="project-card"
            :style="{ '--card-delay': `${index * 150}ms` }"
          >
            <!-- Decorative cover -->
            <div class="project-cover" :class="project.coverClass">
              <div class="cover-top">
                <span class="cover-number">
                  {{ String(index + 1).padStart(2, '0') }} / 03
                </span>

                <span class="cover-status">
                  <span class="status-dot"></span>
                  {{ project.status }}
                </span>
              </div>

              <div class="cover-decoration">
                <div class="decoration-ring ring-one"></div>
                <div class="decoration-ring ring-two"></div>
                <div class="decoration-ring ring-three"></div>

                <svg
                  v-if="project.id === 'ethereum'"
                  class="project-symbol ethereum-symbol"
                  viewBox="0 0 100 130"
                  fill="none"
                  aria-hidden="true"
                >
                  <path
                    d="M50 5 17 66 50 85 83 66 50 5Z"
                    fill="currentColor"
                  />
                  <path
                    d="M17 74 50 125 83 74 50 94 17 74Z"
                    fill="currentColor"
                    opacity=".58"
                  />
                  <path
                    d="M50 5V85L17 66 50 5Z"
                    fill="#FFFFFF"
                    opacity=".28"
                  />
                </svg>

                <svg
                  v-else-if="project.id === 'seamless'"
                  class="project-symbol"
                  viewBox="0 0 100 100"
                  fill="none"
                  aria-hidden="true"
                >
                  <rect
                    x="16" y="18" width="68" height="68" rx="13"
                    stroke="currentColor" stroke-width="3"
                  />
                  <path
                    d="M35 38V31C35 22 41 17 50 17S65 22 65 31V38"
                    stroke="currentColor" stroke-width="3"
                    stroke-linecap="round"
                  />
                  <path
                    d="M32 52H68M32 63H57"
                    stroke="currentColor" stroke-width="3"
                    stroke-linecap="round"
                  />
                  <circle cx="70" cy="72" r="12" fill="#A7F3D0"/>
                  <path
                    d="m65 72 4 4 7-9"
                    stroke="#123B32" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round"
                  />
                </svg>

                <svg
                  v-else
                  class="project-symbol"
                  viewBox="0 0 110 100"
                  fill="none"
                  aria-hidden="true"
                >
                  <rect
                    x="8" y="12" width="94" height="75" rx="10"
                    stroke="currentColor" stroke-width="3"
                  />
                  <path d="M8 31H102" stroke="currentColor" stroke-width="3"/>
                  <circle cx="20" cy="22" r="2" fill="currentColor"/>
                  <circle cx="28" cy="22" r="2" fill="currentColor"/>
                  <circle cx="36" cy="22" r="2" fill="currentColor"/>
                  <path
                    d="m32 47-9 9 9 9M48 69l13-26M72 47l9 9-9 9"
                    stroke="currentColor" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round"
                  />
                </svg>
              </div>

              <div class="cover-bottom">
                <span>{{ project.category }}</span>
                <span class="cover-open">↗</span>
              </div>
            </div>

            <!-- Card content -->
            <div class="project-card-body">
              <div class="project-type">{{ project.type }}</div>
              <h3>{{ project.title }}</h3>
              <p class="project-summary">{{ project.summary }}</p>

              <div class="technology-list">
                <span
                  v-for="technology in project.technologies"
                  :key="technology"
                  class="technology-tag"
                >
                  {{ technology }}
                </span>
              </div>

              <div class="card-bottom">
                <span class="availability-label">
                  {{ project.github ? 'SOURCE AVAILABLE' : project.availability }}
                </span>

                <button
                  class="explore-button"
                  type="button"
                  :aria-label="`View details for ${project.title}`"
                  @click="openProject(project)"
                >
                  <span>View project</span>
                  <span class="explore-arrow">↗</span>
                </button>
              </div>
            </div>
          </article>
        </div>

        <footer class="section-footer">
          <span class="footer-line"></span>
          <p>Learning through building. Improving with every project.</p>
          <span class="footer-line"></span>
        </footer>
      </div>

      <!-- FULL-PAGE PROJECT DETAILS -->
      <div
        v-else
        ref="detailView"
        class="project-detail-view"
        :key="selectedProject.id"
      >
        <button
          type="button"
          class="back-button"
          @click="backToProjects"
        >
          <span class="back-icon">←</span>
          Back to Projects
        </button>

        <div class="detail-hero">
          <div class="detail-intro">
            <span class="eyebrow">
              <span class="status-dot"></span>
              {{ selectedProject.category }}
            </span>

            <p class="detail-index">
              PROJECT {{ projectNumber(selectedProject) }}
              <span>/</span>
              {{ selectedProject.type }}
            </p>

            <h1>{{ selectedProject.title }}</h1>
            <p class="detail-lead">{{ selectedProject.description }}</p>

            <div class="detail-actions">
              <a
                v-if="selectedProject.github"
                :href="selectedProject.github"
                target="_blank"
                rel="noopener noreferrer"
                class="github-button"
              >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    fill="currentColor"
                    d="M12 .9a11.1 11.1 0 0 0-3.51 21.63c.55.1.76-.24.76-.53v-2.08c-3.1.67-3.76-1.32-3.76-1.32-.5-1.29-1.24-1.63-1.24-1.63-1.01-.69.08-.68.08-.68 1.12.08 1.71 1.15 1.71 1.15.99 1.7 2.6 1.21 3.24.92.1-.72.39-1.21.7-1.49-2.48-.28-5.09-1.24-5.09-5.52 0-1.22.44-2.21 1.15-2.99-.12-.28-.5-1.42.11-2.96 0 0 .94-.3 3.05 1.14a10.6 10.6 0 0 1 5.56 0c2.12-1.44 3.05-1.14 3.05-1.14.61 1.54.23 2.68.11 2.96.72.78 1.15 1.77 1.15 2.99 0 4.29-2.61 5.23-5.1 5.51.4.35.75 1.02.75 2.06V22c0 .29.2.63.77.52A11.1 11.1 0 0 0 12 .9Z"
                  />
                </svg>
                View GitHub Repository
                <span>↗</span>
              </a>

              <span v-else class="repository-note">
                <span class="note-dot"></span>
                {{ selectedProject.availability }}
              </span>
            </div>
          </div>

          <div class="detail-art" :class="selectedProject.coverClass">
            <span class="art-caption">PROJECT OVERVIEW</span>

            <div class="art-center">
              <span class="art-number">{{ projectNumber(selectedProject) }}</span>
              <span class="art-title">{{ selectedProject.shortTitle }}</span>
              <span class="art-subtitle">{{ selectedProject.category }}</span>
            </div>

            <div class="art-orbit art-orbit-one"></div>
            <div class="art-orbit art-orbit-two"></div>
          </div>
        </div>

        <div class="detail-layout">
          <main class="detail-main">
            <section class="detail-section">
              <span class="section-kicker">01 — PROJECT OVERVIEW</span>
              <h2>About the project</h2>
              <p>{{ selectedProject.about }}</p>
            </section>

            <section class="detail-section">
              <span class="section-kicker">02 — KEY AREAS</span>
              <h2>Project highlights</h2>

              <div class="feature-list">
                <div
                  v-for="(feature, index) in selectedProject.features"
                  :key="feature"
                  class="feature-row"
                >
                  <span class="feature-index">
                    {{ String(index + 1).padStart(2, '0') }}
                  </span>
                  <p>{{ feature }}</p>
                  <span class="feature-arrow">↗</span>
                </div>
              </div>
            </section>

            <section class="detail-section">
              <span class="section-kicker">03 — TOOLS & TECHNOLOGY</span>
              <h2>Built with</h2>

              <div class="detail-technologies">
                <span
                  v-for="technology in selectedProject.technologies"
                  :key="technology"
                  class="detail-technology"
                >
                  {{ technology }}
                </span>
              </div>
            </section>
          </main>

          <aside class="detail-sidebar">
            <div class="info-panel">
              <span class="section-kicker">AT A GLANCE</span>
              <h3>Project information</h3>

              <div class="info-item">
                <span>Project type</span>
                <strong>{{ selectedProject.type }}</strong>
              </div>

              <div class="info-item">
                <span>Role</span>
                <strong>{{ selectedProject.role }}</strong>
              </div>

              <div class="info-item">
                <span>Primary focus</span>
                <strong>{{ selectedProject.focus }}</strong>
              </div>

              <div class="info-item">
                <span>Repository</span>
                <strong>
                  {{ selectedProject.github ? 'Available on GitHub' : 'Not publicly available' }}
                </strong>
              </div>

              <a
                v-if="selectedProject.github"
                :href="selectedProject.github"
                target="_blank"
                rel="noopener noreferrer"
                class="sidebar-link"
              >
                Open repository <span>↗</span>
              </a>
            </div>

            <div class="more-projects-panel">
              <span class="section-kicker">EXPLORE MORE</span>
              <h3>See another project.</h3>
              <p>
                Return to the project collection to explore the rest of my work.
              </p>

              <button
                type="button"
                class="all-projects-button"
                @click="backToProjects"
              >
                All projects <span>→</span>
              </button>
            </div>
          </aside>
        </div>

        <footer class="section-footer detail-footer">
          <span class="footer-line"></span>
          <p>Thanks for exploring my work.</p>
          <span class="footer-line"></span>
        </footer>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, nextTick } from 'vue'

const selectedProject = ref(null)
const detailView = ref(null)

const particles = Array.from({ length: 28 }, (_, index) => ({
  id: index,
  left: `${(index * 37 + 11) % 100}%`,
  top: `${(index * 53 + 7) % 100}%`,
  duration: `${7 + (index % 8)}s`,
  delay: `${-(index % 9)}s`,
  size: `${2 + (index % 3)}px`,
}))

const projects = [
  {
    id: 'ethereum',
    title: 'Finding Suspicious Transactions in Ethereum Network',
    shortTitle: 'Ethereum Analysis',
    category: 'DATA ANALYSIS',
    type: 'MCA Final-Year Project',
    status: 'ACADEMIC',
    coverClass: 'ethereum-cover',
    summary:
      'An academic project exploring Ethereum transaction data and patterns that may indicate suspicious activity.',
    description:
      'A blockchain-related academic project focused on analysing Ethereum transactions and exploring unusual transaction patterns through data-driven techniques.',
    about:
      'This MCA final-year project explores transaction data from the Ethereum network. Its focus is to study transaction behaviour, analyse relevant attributes and identify patterns that may deserve further investigation. The exact methods and results should reflect the implementation in the project repository.',
    role: 'Academic project',
    focus: 'Ethereum transaction analysis',
    availability: 'SOURCE AVAILABLE',
    technologies: [
      'Python',
      'Ethereum',
      'Data Analysis',
      'Machine Learning',
    ],
    features: [
      'Explore Ethereum transaction data and its relevant attributes.',
      'Analyse transaction behaviour to identify potentially unusual patterns.',
      'Apply data analysis concepts to a blockchain-related problem.',
      'Organise findings to support further investigation.',
    ],
    github: 'https://github.com/swethas25022004-art/project',
  },
  {
    id: 'seamless',
    title: 'Seamless E-Commerce Online Shopping Experience',
    shortTitle: 'Seamless Store',
    category: 'WEB DEVELOPMENT',
    type: 'BCA Final-Year Group Project',
    status: 'ACADEMIC',
    coverClass: 'seamless-cover',
    summary:
      'A BCA group project centred on creating a convenient and user-friendly online shopping experience.',
    description:
      'Seamless is a BCA final-year group project based on an e-commerce shopping experience, with an emphasis on presenting products and making shopping easier to navigate.',
    about:
      'This project was part of my BCA final-year academic work. The concept focuses on an online shopping journey and the overall user experience. The original source files are not currently linked from this portfolio, so implementation details can be refined when those files are available.',
    role: 'Group project',
    focus: 'E-commerce user experience',
    availability: 'ACADEMIC PROJECT',
    technologies: [
      'E-Commerce',
      'Web Development',
      'UI Design',
      'Teamwork',
    ],
    features: [
      'Focus on a straightforward online shopping journey.',
      'Consider how product information can be organised for browsing.',
      'Explore usability and interface design for e-commerce.',
      'Collaborate on an academic group project.',
    ],
    github: null,
  },
  {
    id: 'portfolio',
    title: 'Personal Developer Portfolio',
    shortTitle: 'My Portfolio',
    category: 'FULL STACK DEVELOPMENT',
    type: 'Personal Project',
    status: 'IN PROGRESS',
    coverClass: 'portfolio-cover',
    summary:
      'A personal website presenting my skills, academic projects, experience and professional profile.',
    description:
      'A modern developer portfolio built to bring my profile, technical skills, experience, projects and certificates together in one professional website.',
    about:
      'This personal portfolio is being developed with a Vue.js frontend and Laravel/PHP backend. It is intended to present my professional journey, showcase selected work and make it easy for visitors to explore my skills and contact information.',
    role: 'Full Stack Developer',
    focus: 'Portfolio development',
    availability: 'IN PROGRESS',
    technologies: [
      'Vue.js',
      'Laravel',
      'PHP',
      'MySQL',
    ],
    features: [
      'Present profile, education and technical skills.',
      'Showcase academic projects and professional experience.',
      'Organise certificates and resume access in one place.',
      'Build a responsive interface using reusable Vue components.',
    ],
    github: null,
  },
]

function projectNumber(project) {
  const index = projects.findIndex(item => item.id === project.id)
  return String(index + 1).padStart(2, '0')
}

/*
 * FIX:
 * Render the selected project's details first.
 * Then scroll directly to the details container,
 * instead of scrolling to the top of the entire website.
 */
async function openProject(project) {
  selectedProject.value = project

  await nextTick()

  detailView.value?.scrollIntoView({
    behavior: 'auto',
    block: 'start',
  })
}

async function backToProjects() {
  selectedProject.value = null

  await nextTick()

  document.getElementById('projects')?.scrollIntoView({
    behavior: 'auto',
    block: 'start',
  })
}
</script>

<style scoped>
/* ================= BASE & BACKGROUND ================= */
.projects-section {
  --accent: #76e6ce;
  --accent-blue: #91b6ff;
  --text: #f3f7ff;
  --muted: #a1b1c7;
  --border: rgba(164, 194, 223, 0.15);

  position: relative;
  isolation: isolate;
  min-height: 100vh;
  overflow: hidden;
  padding: 105px 0 75px;
  color: var(--text);
  background:
    radial-gradient(ellipse at 10% 5%, rgba(26, 108, 118, 0.19), transparent 36%),
    radial-gradient(ellipse at 90% 55%, rgba(64, 75, 160, 0.16), transparent 38%),
    linear-gradient(140deg, #07111f 0%, #0b192a 48%, #07101d 100%);
}

.projects-container {
  position: relative;
  z-index: 2;
  width: min(1180px, calc(100% - 48px));
  margin: 0 auto;
}

.background-grid {
  position: absolute;
  inset: 0;
  z-index: -3;
  pointer-events: none;
  opacity: 0.16;
  background-image:
    linear-gradient(rgba(150, 185, 215, 0.08) 1px, transparent 1px),
    linear-gradient(90deg, rgba(150, 185, 215, 0.08) 1px, transparent 1px);
  background-size: 52px 52px;
  mask-image: linear-gradient(to bottom, black, transparent 90%);
}

.ambient-glow {
  position: absolute;
  z-index: -2;
  width: 390px;
  height: 390px;
  border-radius: 50%;
  filter: blur(100px);
  opacity: 0.19;
  pointer-events: none;
  animation: glowDrift 15s ease-in-out infinite alternate;
}

.glow-left {
  top: 3%;
  left: -230px;
  background: #16cbb1;
}

.glow-right {
  top: 35%;
  right: -230px;
  background: #526eff;
  animation-delay: -6s;
}

.glow-bottom {
  bottom: -260px;
  left: 35%;
  background: #216a9b;
  animation-delay: -10s;
}

.particles {
  position: absolute;
  inset: 0;
  z-index: -1;
  overflow: hidden;
  pointer-events: none;
}

.particle {
  position: absolute;
  width: var(--size);
  height: var(--size);
  border-radius: 50%;
  background: var(--accent);
  opacity: 0;
  box-shadow: 0 0 12px rgba(118, 230, 206, 0.7);
  animation: particleDrift var(--duration) var(--delay) ease-in-out infinite;
}

/* ================= SECTION HEADING ================= */
.section-heading {
  max-width: 780px;
  margin: 0 auto 58px;
  text-align: center;
  animation: fadeUp 0.75s ease both;
}

.eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  color: var(--accent);
  font-size: 0.7rem;
  font-weight: 800;
  letter-spacing: 0.2em;
}

.status-dot {
  width: 7px;
  height: 7px;
  flex: 0 0 auto;
  border-radius: 50%;
  background: var(--accent);
  box-shadow: 0 0 13px rgba(118, 230, 206, 0.8);
}

.section-heading h2 {
  margin: 22px 0 17px;
  font-size: clamp(2rem, 4.5vw, 3.45rem);
  font-weight: 760;
  line-height: 1.16;
  letter-spacing: -0.045em;
}

.gradient-text {
  display: block;
  color: var(--accent);
  background: linear-gradient(90deg, #76e6ce, #91b6ff, #76e6ce);
  background-size: 200% auto;
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradientFlow 7s linear infinite;
}

.section-heading > p {
  max-width: 650px;
  margin: 0 auto;
  color: var(--muted);
  font-size: 0.96rem;
  line-height: 1.9;
}

.heading-meta {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 13px;
  margin-top: 27px;
  color: #7f95ae;
  font-size: 0.64rem;
  font-weight: 800;
  letter-spacing: 0.13em;
}

.meta-divider {
  width: 4px;
  height: 4px;
  border-radius: 50%;
  background: var(--accent);
}

/* ================= PROJECT CARDS ================= */
.projects-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 24px;
  align-items: stretch;
}

.project-card {
  display: flex;
  flex-direction: column;
  min-width: 0;
  min-height: 100%;
  overflow: hidden;
  border: 1px solid var(--border);
  border-radius: 19px;
  background: linear-gradient(150deg, rgba(19, 35, 56, 0.97), rgba(10, 23, 39, 0.97));
  box-shadow: 0 18px 45px rgba(0, 0, 0, 0.16);
  opacity: 0;
  animation: fadeUp 0.75s ease forwards;
  animation-delay: var(--card-delay, 0ms);
  transition: transform 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease;
}

.project-card:hover {
  transform: translateY(-8px);
  border-color: rgba(118, 230, 206, 0.48);
  box-shadow: 0 24px 55px rgba(0, 0, 0, 0.28), 0 0 30px rgba(118, 230, 206, 0.045);
}

.project-cover {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 225px;
  min-height: 225px;
  overflow: hidden;
  padding: 19px;
  isolation: isolate;
}

.project-cover::before {
  position: absolute;
  inset: 0;
  z-index: -1;
  content: "";
  opacity: 0.55;
  background-image:
    linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
  background-size: 25px 25px;
}

.ethereum-cover {
  color: #c2b7ff;
  background: linear-gradient(135deg, #2c2859, #141d38 80%);
}

.seamless-cover {
  color: #a7f3d0;
  background: linear-gradient(135deg, #174b43, #102b34 80%);
}

.portfolio-cover {
  color: #a6c5ff;
  background: linear-gradient(135deg, #1b3b65, #15213c 80%);
}

.cover-top,
.cover-bottom {
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}

.cover-number,
.cover-status,
.cover-bottom > span:first-child {
  font-size: 0.61rem;
  font-weight: 800;
  letter-spacing: 0.12em;
}

.cover-status {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border: 1px solid currentColor;
  border-radius: 20px;
  background: rgba(0, 0, 0, 0.1);
  font-size: 0.55rem;
}

.cover-status .status-dot {
  width: 5px;
  height: 5px;
  box-shadow: none;
}

.cover-decoration {
  position: absolute;
  inset: 0;
  display: grid;
  place-items: center;
}

.project-symbol {
  position: relative;
  z-index: 1;
  width: 88px;
  height: 88px;
  color: inherit;
  filter: drop-shadow(0 12px 20px rgba(0, 0, 0, 0.2));
  animation: symbolFloat 5s ease-in-out infinite;
}

.ethereum-symbol {
  width: 70px;
  height: 92px;
}

.decoration-ring {
  position: absolute;
  width: 145px;
  height: 145px;
  border: 1px solid currentColor;
  border-radius: 50%;
  opacity: 0.15;
  animation: ringRotate 30s linear infinite;
}

.ring-two {
  transform: scaleX(1.4) rotate(60deg);
  animation-duration: 36s;
  animation-direction: reverse;
}

.ring-three {
  width: 180px;
  height: 180px;
  border-style: dashed;
  opacity: 0.09;
  animation-duration: 48s;
}

.cover-open {
  font-size: 1.15rem;
  transition: transform 0.3s ease;
}

.project-card:hover .cover-open {
  transform: translate(3px, -3px);
}

.project-card-body {
  display: flex;
  flex: 1;
  flex-direction: column;
  align-items: flex-start;
  padding: 24px 22px 20px;
}

.project-type {
  margin-bottom: 11px;
  color: var(--accent);
  font-size: 0.64rem;
  font-weight: 800;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}

.project-card-body h3 {
  margin: 0 0 13px;
  color: var(--text);
  font-size: 1.15rem;
  font-weight: 720;
  line-height: 1.5;
  letter-spacing: -0.02em;
}

.project-summary {
  margin: 0 0 20px;
  color: var(--muted);
  font-size: 0.85rem;
  line-height: 1.85;
}

.technology-list,
.detail-technologies {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.technology-tag,
.detail-technology {
  padding: 7px 9px;
  border: 1px solid rgba(164, 194, 223, 0.14);
  border-radius: 6px;
  background: rgba(164, 194, 223, 0.055);
  color: #c6d5e5;
  font-size: 0.66rem;
  line-height: 1.3;
}

.card-bottom {
  display: flex;
  flex-direction: column;
  align-items: stretch;
  gap: 16px;
  width: 100%;
  margin-top: auto;
  padding-top: 21px;
}

.availability-label {
  color: #7f95ae;
  font-size: 0.59rem;
  font-weight: 800;
  letter-spacing: 0.12em;
}

.explore-button {
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 15px 0 0;
  border: 0;
  border-top: 1px solid var(--border);
  background: transparent;
  color: var(--text);
  font: inherit;
  font-size: 0.83rem;
  font-weight: 720;
  text-align: left;
  cursor: pointer;
}

.explore-arrow {
  display: grid;
  width: 31px;
  height: 31px;
  place-items: center;
  border: 1px solid var(--border);
  border-radius: 50%;
  color: var(--accent);
  transition: transform 0.3s ease, background 0.3s ease;
}

.explore-button:hover .explore-arrow {
  transform: translateX(4px);
  background: rgba(118, 230, 206, 0.1);
}

.explore-button:focus-visible,
.back-button:focus-visible,
.github-button:focus-visible,
.all-projects-button:focus-visible {
  outline: 2px solid var(--accent);
  outline-offset: 5px;
}

/* ================= FOOTER ================= */
.section-footer {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  margin-top: 52px;
  color: var(--muted);
  text-align: center;
}

.section-footer p {
  margin: 0;
  font-size: 0.77rem;
  line-height: 1.8;
}

.footer-line {
  width: 48px;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(118, 230, 206, 0.55));
}

.footer-line:last-child {
  transform: rotate(180deg);
}

/* ================= FULL-PAGE DETAIL VIEW ================= */
.project-detail-view {
  scroll-margin-top: 90px;
  animation: detailEnter 0.55s ease both;
}

.back-button {
  display: inline-flex;
  align-items: center;
  gap: 11px;
  margin-bottom: 32px;
  padding: 8px 0;
  border: 0;
  background: transparent;
  color: #c5d3e3;
  font: inherit;
  font-size: 0.84rem;
  font-weight: 650;
  cursor: pointer;
  transition: color 0.25s ease;
}

.back-button:hover {
  color: var(--accent);
}

.back-icon {
  display: grid;
  width: 36px;
  height: 36px;
  place-items: center;
  border: 1px solid var(--border);
  border-radius: 50%;
  font-size: 1.1rem;
  transition: transform 0.25s ease, border-color 0.25s ease;
}

.back-button:hover .back-icon {
  transform: translateX(-4px);
  border-color: var(--accent);
}

.detail-hero {
  display: grid;
  grid-template-columns: minmax(0, 1.1fr) minmax(280px, 0.9fr);
  align-items: center;
  gap: 52px;
  padding: 26px 0 62px;
  border-bottom: 1px solid var(--border);
}

.detail-intro {
  animation: fadeUp 0.65s ease both;
}

.detail-index {
  margin: 25px 0 13px;
  color: #8198b1;
  font-size: 0.68rem;
  font-weight: 800;
  letter-spacing: 0.11em;
  line-height: 1.8;
}

.detail-index span {
  margin: 0 7px;
  color: var(--accent);
}

.detail-intro h1 {
  margin: 0 0 20px;
  color: var(--text);
  font-size: clamp(2rem, 4vw, 3.5rem);
  font-weight: 760;
  line-height: 1.15;
  letter-spacing: -0.045em;
  overflow-wrap: anywhere;
}

.detail-lead {
  max-width: 590px;
  margin: 0;
  color: var(--muted);
  font-size: 0.94rem;
  line-height: 1.95;
}

.detail-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin-top: 27px;
}

.github-button {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  padding: 14px 17px;
  border: 1px solid rgba(118, 230, 206, 0.36);
  border-radius: 8px;
  background: rgba(118, 230, 206, 0.09);
  color: var(--accent);
  font-size: 0.81rem;
  font-weight: 750;
  text-decoration: none;
  transition: transform 0.25s ease, background 0.25s ease;
}

.github-button:hover {
  transform: translateY(-2px);
  background: rgba(118, 230, 206, 0.16);
}

.github-button svg {
  width: 18px;
  height: 18px;
}

.github-button > span {
  margin-left: 3px;
}

.repository-note {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  padding: 12px 0;
  color: #b3c5d8;
  font-size: 0.82rem;
  font-weight: 650;
}

.note-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #8da4bd;
}

.detail-art {
  position: relative;
  display: grid;
  min-height: 345px;
  overflow: hidden;
  place-items: center;
  border: 1px solid rgba(164, 194, 223, 0.18);
  border-radius: 22px;
  isolation: isolate;
  animation: fadeUp 0.7s 0.12s ease both;
}

.detail-art::before {
  position: absolute;
  inset: 0;
  z-index: -1;
  content: "";
  background-image:
    linear-gradient(rgba(255, 255, 255, 0.045) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.045) 1px, transparent 1px);
  background-size: 28px 28px;
}

.art-caption {
  position: absolute;
  top: 21px;
  left: 21px;
  color: currentColor;
  font-size: 0.59rem;
  font-weight: 800;
  letter-spacing: 0.14em;
}

.art-center {
  position: relative;
  z-index: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 25px;
  text-align: center;
}

.art-number {
  margin-bottom: 12px;
  font-size: 5rem;
  font-weight: 800;
  line-height: 1;
  letter-spacing: -0.08em;
  opacity: 0.9;
}

.art-title {
  max-width: 280px;
  font-size: 1.18rem;
  font-weight: 750;
  line-height: 1.45;
}

.art-subtitle {
  margin-top: 12px;
  font-size: 0.62rem;
  font-weight: 800;
  letter-spacing: 0.14em;
  opacity: 0.78;
}

.art-orbit {
  position: absolute;
  width: 260px;
  height: 260px;
  border: 1px solid currentColor;
  border-radius: 50%;
  opacity: 0.15;
  pointer-events: none;
  animation: ringRotate 35s linear infinite;
}

.art-orbit-two {
  width: 340px;
  height: 340px;
  border-style: dashed;
  opacity: 0.09;
  animation-direction: reverse;
  animation-duration: 48s;
}

/* ================= DETAIL CONTENT ================= */
.detail-layout {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 315px;
  align-items: start;
  gap: 60px;
  padding-top: 54px;
}

.detail-main {
  min-width: 0;
}

.detail-section + .detail-section {
  margin-top: 52px;
}

.section-kicker {
  display: block;
  margin-bottom: 14px;
  color: var(--accent);
  font-size: 0.63rem;
  font-weight: 800;
  letter-spacing: 0.15em;
}

.detail-section h2 {
  margin: 0 0 18px;
  color: var(--text);
  font-size: 1.55rem;
  font-weight: 720;
  line-height: 1.4;
  letter-spacing: -0.025em;
}

.detail-section > p {
  margin: 0;
  color: var(--muted);
  font-size: 0.91rem;
  line-height: 1.95;
}

.feature-list {
  border-top: 1px solid var(--border);
}

.feature-row {
  display: grid;
  grid-template-columns: 36px minmax(0, 1fr) 20px;
  align-items: start;
  gap: 14px;
  padding: 19px 0;
  border-bottom: 1px solid var(--border);
}

.feature-index {
  padding-top: 3px;
  color: var(--accent);
  font-size: 0.72rem;
  font-weight: 800;
}

.feature-row p {
  margin: 0;
  color: #c3d1e1;
  font-size: 0.86rem;
  line-height: 1.85;
}

.feature-arrow {
  color: var(--accent);
  font-size: 0.95rem;
}

.detail-technologies {
  gap: 10px;
}

.detail-technology {
  padding: 10px 13px;
  font-size: 0.76rem;
}

.detail-sidebar {
  display: flex;
  flex-direction: column;
  gap: 19px;
}

.info-panel,
.more-projects-panel {
  padding: 24px;
  border: 1px solid var(--border);
  border-radius: 15px;
  background: linear-gradient(150deg, rgba(19, 35, 56, 0.9), rgba(10, 23, 39, 0.9));
}

.info-panel h3,
.more-projects-panel h3 {
  margin: 0 0 18px;
  color: var(--text);
  font-size: 1.15rem;
  font-weight: 720;
  line-height: 1.45;
}

.info-item {
  display: flex;
  flex-direction: column;
  gap: 7px;
  padding: 14px 0;
  border-bottom: 1px solid rgba(164, 194, 223, 0.1);
}

.info-item > span {
  color: #8298b1;
  font-size: 0.73rem;
}

.info-item strong {
  color: #e4edf8;
  font-size: 0.83rem;
  font-weight: 650;
  line-height: 1.6;
  overflow-wrap: anywhere;
}

.sidebar-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-top: 20px;
  color: var(--accent);
  font-size: 0.81rem;
  font-weight: 750;
  text-decoration: none;
}

.sidebar-link:hover {
  text-decoration: underline;
}

.more-projects-panel {
  background:
    radial-gradient(circle at 100% 0%, rgba(118, 230, 206, 0.1), transparent 55%),
    rgba(12, 27, 44, 0.9);
}

.more-projects-panel > p {
  margin: 0;
  color: var(--muted);
  font-size: 0.82rem;
  line-height: 1.85;
}

.all-projects-button {
  display: flex;
  width: 100%;
  align-items: center;
  justify-content: space-between;
  margin-top: 21px;
  padding: 14px 0 0;
  border: 0;
  border-top: 1px solid var(--border);
  background: transparent;
  color: var(--accent);
  font: inherit;
  font-size: 0.82rem;
  font-weight: 750;
  cursor: pointer;
}

.detail-footer {
  margin-top: 65px;
  padding-top: 25px;
  border-top: 1px solid var(--border);
}

/* ================= MOTION ================= */
@keyframes fadeUp {
  from {
    opacity: 0;
    transform: translateY(22px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes detailEnter {
  from {
    opacity: 0;
    transform: translateY(13px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes glowDrift {
  from {
    transform: translate3d(0, 0, 0) scale(1);
  }
  to {
    transform: translate3d(45px, 35px, 0) scale(1.12);
  }
}

@keyframes particleDrift {
  0% {
    opacity: 0;
    transform: translate3d(0, 20px, 0);
  }
  30% {
    opacity: 0.6;
  }
  70% {
    opacity: 0.35;
  }
  100% {
    opacity: 0;
    transform: translate3d(20px, -65px, 0);
  }
}

@keyframes symbolFloat {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-8px);
  }
}

@keyframes ringRotate {
  to {
    transform: rotate(360deg);
  }
}

@keyframes gradientFlow {
  to {
    background-position: 200% center;
  }
}

/* ================= RESPONSIVE ================= */
@media (max-width: 1000px) {
  .projects-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .detail-hero {
    gap: 30px;
  }

  .detail-layout {
    grid-template-columns: minmax(0, 1fr) 285px;
    gap: 32px;
  }
}

@media (max-width: 760px) {
  .projects-section {
    padding: 80px 0 60px;
  }

  .projects-container {
    width: min(100% - 32px, 600px);
  }

  .section-heading {
    margin-bottom: 36px;
  }

  .projects-grid {
    grid-template-columns: minmax(0, 1fr);
    gap: 20px;
  }

  .project-cover {
    height: 215px;
    min-height: 215px;
  }

  .project-card-body {
    padding: 23px;
  }

  .detail-hero {
    grid-template-columns: minmax(0, 1fr);
    gap: 30px;
    padding-top: 15px;
    padding-bottom: 38px;
  }

  .detail-intro h1 {
    font-size: clamp(2rem, 8vw, 3rem);
  }

  .detail-art {
    min-height: 285px;
  }

  .detail-layout {
    grid-template-columns: minmax(0, 1fr);
    gap: 38px;
    padding-top: 38px;
  }

  .detail-section + .detail-section {
    margin-top: 40px;
  }

  .detail-sidebar {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
  }

  .back-button {
    margin-bottom: 24px;
  }

  .project-detail-view {
    scroll-margin-top: 76px;
  }
}

@media (max-width: 420px) {
  .projects-container {
    width: calc(100% - 28px);
  }

  .section-heading h2 {
    font-size: 2rem;
  }

  .heading-meta {
    gap: 8px;
    font-size: 0.55rem;
  }

  .section-footer {
    gap: 8px;
  }

  .section-footer p {
    font-size: 0.7rem;
  }

  .footer-line {
    width: 22px;
  }

  .feature-row {
    grid-template-columns: 29px minmax(0, 1fr) 16px;
    gap: 10px;
  }

  .info-panel,
  .more-projects-panel {
    padding: 20px;
  }
}

/* Accessibility: respect reduced-motion preferences */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    scroll-behavior: auto !important;
    transition-duration: 0.01ms !important;
  }
}
</style>
```
