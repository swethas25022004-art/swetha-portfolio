```vue
<script setup>
import Navbar from './components/Navbar.vue';
import Hero from './components/Hero.vue';
import About from './components/About.vue';
import Skills from './components/Skills.vue';
import Experience from './components/Experience.vue';
import Projects from './components/Projects.vue';
import Certificates from './components/Certificates.vue';
import Contact from './components/Contact.vue';

import Footer from './components/Footer.vue';
</script>

<template>
    <Navbar />

    <main>
        <Hero />
        <About />
        <Skills />
        <Experience />
        <Projects />
        <Certificates />
        <Contact />
    </main>

    <Footer />
</template>
```
