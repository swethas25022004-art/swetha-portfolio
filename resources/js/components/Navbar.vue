<script setup>
const props = defineProps({
    currentPage: {
        type: String,
        default: 'home',
    },
});

const sectionHref = (section) => props.currentPage === 'contact'
    ? `/#${section}`
    : `#${section}`;
</script>

<template>
    <header class="navbar">
        <div class="nav-container">

            <a href="/" class="logo">
                S<span></span>
            </a>

            <nav class="nav-links">
                <a href="/">Home</a>
                <a :href="sectionHref('about')">About</a>
                <a :href="sectionHref('skills')">Skills</a>
                <a :href="sectionHref('experience')">Experience</a>
                <a :href="sectionHref('projects')">Projects</a>
                <a :href="sectionHref('certificates')">Certificates</a>
                <a href="/contact">Contact</a>
            </nav>

        </div>
    </header>
</template>
