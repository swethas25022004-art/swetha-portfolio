```vue
<script setup>
import { ref } from 'vue';

const props = defineProps({
    currentPage: {
        type: String,
        default: 'home',
    },
});

const menuOpen = ref(false);

const sectionHref = (section) => props.currentPage === 'contact'
    ? `/#${section}`
    : `#${section}`;

const closeMenu = () => {
    menuOpen.value = false;
};
</script>

<template>
    <header class="navbar">
        <div class="nav-container">

            <a href="/" class="logo" @click="closeMenu">
                S<span></span>
            </a>

            <!-- Mobile hamburger button -->
            <button
                class="menu-toggle"
                type="button"
                :aria-expanded="menuOpen"
                aria-label="Toggle navigation menu"
                @click="menuOpen = !menuOpen"
            >
                <span :class="{ active: menuOpen }"></span>
                <span :class="{ active: menuOpen }"></span>
                <span :class="{ active: menuOpen }"></span>
            </button>

            <nav class="nav-links" :class="{ 'mobile-open': menuOpen }">
                <a href="/" @click="closeMenu">Home</a>
                <a :href="sectionHref('about')" @click="closeMenu">About</a>
                <a :href="sectionHref('skills')" @click="closeMenu">Skills</a>
                <a :href="sectionHref('experience')" @click="closeMenu">Experience</a>
                <a :href="sectionHref('projects')" @click="closeMenu">Projects</a>
                <a :href="sectionHref('certificates')" @click="closeMenu">Certificates</a>
                <a href="/contact" @click="closeMenu">Contact</a>
            </nav>

        </div>
    </header>
</template>

<style scoped>
/* Desktop: keep the existing horizontal navigation */
.menu-toggle {
    display: none;
}

/* Mobile only */
@media (max-width: 1024px) {
    .nav-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        width: 100%;
    }

    .logo {
        margin-right: auto;
    }

    .menu-toggle {
        display: flex;
        margin-left: auto;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 1001;
    }

    .menu-toggle span {
        display: block;
        width: 21px;
        height: 2px;
        border-radius: 2px;
        background: currentColor;
        transition: transform 0.25s ease, opacity 0.25s ease;
    }

    .menu-toggle span:nth-child(1).active {
        transform: translateY(7px) rotate(45deg);
    }

    .menu-toggle span:nth-child(2).active {
        opacity: 0;
    }

    .menu-toggle span:nth-child(3).active {
        transform: translateY(-7px) rotate(-45deg);
    }

    .nav-links {
        display: none;
        flex-direction: column;
        align-items: stretch;
        gap: 0;
        width: 100%;
        padding: 10px 0;
        margin-top: 12px;
        border: 1px solid rgba(128, 150, 125, 0.25);
        border-radius: 14px;
        background: var(--navbar-bg, #ffffff);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
    }

    .nav-links.mobile-open {
        display: flex;
    }

    .nav-links a {
        display: block;
        padding: 12px 18px;
        text-decoration: none;
    }
}
</style>
```