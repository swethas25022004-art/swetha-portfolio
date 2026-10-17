```vue
<script setup>
import { onMounted, onUnmounted, ref } from 'vue';

import Navbar from './components/Navbar.vue';
import Hero from './components/Hero.vue';
import About from './components/About.vue';
import Skills from './components/Skills.vue';
import Experience from './components/Experience.vue';
import Projects from './components/Projects.vue';
import Certificates from './components/Certificates.vue';
import Contact from './components/Contact.vue';

import Footer from './components/Footer.vue';
import AnalyticsDashboard from './components/AnalyticsDashboard.vue';
import AdminLogin from './components/AdminLogin.vue';

const isContactPage = window.location.pathname.replace(/\/+$/, '') === '/contact';
const isAnalyticsPage = window.location.pathname.replace(/\/+$/, '') === '/admin/analytics';
const isAdminLoginPage = window.location.pathname.replace(/\/+$/, '') === '/admin/login';
const isProjectDetailOpen = ref(false);
let trackPageNavigation;

function handleProjectDetailChange(isOpen) {
    isProjectDetailOpen.value = isOpen;
}

let sectionObserver;

onMounted(() => {
    if (isAnalyticsPage || isAdminLoginPage) {
        return;
    }

    const visitorIdKey = 'portfolio-analytics-visitor-id';
    let visitorId;

    try {
        visitorId = sessionStorage.getItem(visitorIdKey);

        if (!visitorId) {
            visitorId = crypto.randomUUID();
            sessionStorage.setItem(visitorIdKey, visitorId);
        }
    } catch {
        visitorId = crypto.randomUUID();
    }

    let lastTrackedPage = '';
    trackPageNavigation = () => {
        const section = window.location.hash.slice(1).toLowerCase();
        const page = isContactPage ? 'contact' : ['projects', 'certificates', 'contact'].includes(section) ? section : 'home';

        if (page === lastTrackedPage) {
            return;
        }

        lastTrackedPage = page;
        fetch('/analytics/page-views', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
            },
            body: JSON.stringify({ visitor_id: visitorId, page, referrer: document.referrer || null }),
            keepalive: true,
        }).catch(() => {});
    };

    trackPageNavigation();
    window.addEventListener('hashchange', trackPageNavigation);
    window.addEventListener('popstate', trackPageNavigation);

    if (!('IntersectionObserver' in window)) {
        return;
    }

    sectionObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-in-view');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -6% 0px',
    });

    document.querySelectorAll('main > section:not(#home)').forEach((section) => {
        section.classList.add('section-reveal');
        sectionObserver.observe(section);
    });
});

onUnmounted(() => {
    sectionObserver?.disconnect();

    if (trackPageNavigation) {
        window.removeEventListener('hashchange', trackPageNavigation);
        window.removeEventListener('popstate', trackPageNavigation);
    }
});
</script>

<template>
    <AdminLogin v-if="isAdminLoginPage" />
    <AnalyticsDashboard v-else-if="isAnalyticsPage" />
    <template v-else>
    <Navbar v-show="!isProjectDetailOpen" :current-page="isContactPage ? 'contact' : 'home'" />

    <main>
        <Contact v-if="isContactPage" />
        <template v-else>
            <Hero v-show="!isProjectDetailOpen" />
            <About v-show="!isProjectDetailOpen" />
            <Skills v-show="!isProjectDetailOpen" />
            <Experience v-show="!isProjectDetailOpen" />
            <Projects @project-detail-change="handleProjectDetailChange" />
            <Certificates v-show="!isProjectDetailOpen" />
            <Contact v-show="!isProjectDetailOpen" />
        </template>
    </main>

    <Footer v-show="!isProjectDetailOpen" :current-page="isContactPage ? 'contact' : 'home'" />
    </template>
</template>
```
