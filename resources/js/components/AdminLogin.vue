<script setup>
import { ref } from 'vue';

const email = ref('');
const password = ref('');
const error = ref('');
const isSubmitting = ref(false);

async function signIn() {
    isSubmitting.value = true;
    error.value = '';

    try {
        const response = await fetch('/admin/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
            },
            body: JSON.stringify({ email: email.value, password: password.value }),
        });
        const result = await response.json();

        if (!response.ok) {
            error.value = result.errors?.email?.[0] ?? result.errors?.password?.[0] ?? 'Unable to sign in. Check your details and try again.';
            return;
        }

        window.location.assign(result.redirect);
    } catch {
        error.value = 'A connection error occurred. Please try again.';
    } finally {
        isSubmitting.value = false;
    }
}
</script>

<template>
    <main class="login-screen">
        <section class="login-panel" aria-labelledby="login-title">
            <a class="brand" href="/" aria-label="Swetha portfolio home"><span class="brand-mark">S</span><span>swetha<span class="brand-dot">.</span></span></a>
            <div class="login-intro"><span class="eyebrow">PRIVATE WORKSPACE</span><h1 id="login-title">Welcome back.</h1><p>Sign in to view your portfolio analytics.</p></div>
            <form class="login-form" @submit.prevent="signIn">
                <label for="email">Email address</label>
                <input id="email" v-model="email" type="email" autocomplete="username" required>
                <label for="password">Password</label>
                <input id="password" v-model="password" type="password" autocomplete="current-password" required>
                <p v-if="error" class="form-error" role="alert">{{ error }}</p>
                <button type="submit" :disabled="isSubmitting">{{ isSubmitting ? 'Signing in...' : 'Sign in' }}<span aria-hidden="true">→</span></button>
            </form>
            <a class="back-link" href="/">← Back to portfolio</a>
        </section>
        <aside class="login-aside" aria-hidden="true">
            <div class="aside-topline"><span></span> PORTFOLIO INTELLIGENCE</div>
            <div class="aside-content"><span class="aside-index">01 / INSIGHTS</span><p class="aside-quote">A clearer view of<br>what's <em>resonating.</em></p>
                <div class="mini-chart"><div class="chart-caption"><span>VISITOR MOMENTUM</span><span>7 DAYS</span></div>
                    <svg viewBox="0 0 430 130" role="presentation"><path class="chart-area" d="M0,105 C42,95 48,74 92,82 S148,96 183,61 S244,78 277,44 S342,54 368,27 S402,39 430,10 L430,130 L0,130 Z"/><path class="chart-line" d="M0,105 C42,95 48,74 92,82 S148,96 183,61 S244,78 277,44 S342,54 368,27 S402,39 430,10"/><circle cx="430" cy="10" r="5"/></svg>
                    <div class="chart-days"><span>MON</span><span>TUE</span><span>WED</span><span>THU</span><span>FRI</span><span>SAT</span><span>SUN</span></div>
                </div>
            </div>
            <div class="aside-footer"><span>SWETHA'S PORTFOLIO</span><span>PRIVATE · 2026</span></div>
        </aside>
    </main>
</template>

<style scoped>
.login-screen { --ink: #202332; --muted: #818597; min-height: 100vh; display: grid; grid-template-columns: minmax(380px, .88fr) minmax(480px, 1.12fr); color: var(--ink); background: #fff; font-family: 'DM Sans', sans-serif; }
.login-panel { width: min(390px, calc(100% - 52px)); margin: auto; padding: 50px 0; }
.brand { display: inline-flex; align-items: center; gap: 11px; color: var(--ink); font-size: 19px; font-weight: 700; text-decoration: none; }
.brand-mark { display: grid; width: 38px; aspect-ratio: 1; place-items: center; border-radius: 12px; color: #fff; background: linear-gradient(145deg, #7a67ef, #4a73d5); font-family: 'Playfair Display', serif; font-size: 21px; }
.brand-dot { color: #6d5be8; }
.login-intro { margin: 74px 0 34px; }
.eyebrow, .aside-index { color: #6d5be8; font-size: 10px; font-weight: 700; letter-spacing: 1.5px; }
.login-intro h1 { margin: 14px 0 8px; font-size: 35px; line-height: 1.12; }
.login-intro p { margin: 0; color: var(--muted); font-size: 14px; }
.login-form { display: grid; gap: 10px; }
.login-form label { margin-top: 10px; font-size: 12px; font-weight: 700; }
.login-form input { width: 100%; height: 48px; box-sizing: border-box; padding: 0 14px; border: 1px solid #e4e6ee; border-radius: 8px; outline: none; background: #fff; color: var(--ink); font: inherit; }
.login-form input:focus { border-color: #8c7cf1; box-shadow: 0 0 0 3px #8c7cf122; }
.login-form button { display: flex; height: 48px; align-items: center; justify-content: space-between; margin-top: 16px; padding: 0 16px; border: 0; border-radius: 8px; background: #6658d9; color: #fff; font: inherit; font-weight: 700; cursor: pointer; transition: background .2s, transform .2s; }
.login-form button:hover:not(:disabled) { transform: translateY(-1px); background: #5546c8; }
.login-form button:disabled { opacity: .7; cursor: wait; }
.form-error { margin: 3px 0 0; color: #bf3545; font-size: 12px; }
.back-link { display: inline-block; margin-top: 26px; color: var(--muted); font-size: 12px; text-decoration: none; }
.login-aside { position: relative; display: flex; min-height: 100vh; flex-direction: column; justify-content: space-between; overflow: hidden; padding: 34px clamp(32px, 6vw, 88px); box-sizing: border-box; background: #f5f6fb; }
.login-aside::before { position: absolute; inset: 0 0 auto auto; width: 58%; height: 100%; background: radial-gradient(ellipse at 90% 8%, #dddafa 0, #e9eafd99 33%, transparent 72%); content: ''; pointer-events: none; }
.aside-topline, .aside-footer { position: relative; display: flex; justify-content: space-between; color: #87899b; font-size: 9px; font-weight: 700; letter-spacing: 1.3px; }
.aside-topline { align-items: center; justify-content: flex-start; gap: 10px; }
.aside-topline span { width: 7px; aspect-ratio: 1; border-radius: 50%; background: #56b795; box-shadow: 0 0 0 4px #56b79522; }
.aside-content { position: relative; width: min(470px, 100%); margin: auto; padding: 70px 0; }
.aside-index { color: #8b85c8; }
.aside-quote { margin: 21px 0 49px; color: #27283a; font-family: 'Playfair Display', serif; font-size: clamp(34px, 4.2vw, 54px); line-height: 1.14; }
.aside-quote em { color: #6d5be8; font-weight: 500; }
.mini-chart { padding: 18px 18px 14px; border: 1px solid #e6e7f0; border-radius: 10px; background: #ffffffc9; box-shadow: 0 16px 40px #34345c0a; }
.chart-caption, .chart-days { display: flex; justify-content: space-between; color: #a1a3b3; font-size: 8px; font-weight: 700; letter-spacing: 1px; }
.mini-chart svg { width: 100%; height: auto; margin-top: 20px; overflow: visible; }
.chart-area { fill: #7565e91c; }
.chart-line { fill: none; stroke: #7565e9; stroke-linecap: round; stroke-width: 2.5; }
.mini-chart circle { fill: #fff; stroke: #7565e9; stroke-width: 3; }
.chart-days { margin-top: 8px; font-size: 7px; }
.aside-footer { color: #a1a3b3; }
@media (max-width: 860px) { .login-screen { display: block; } .login-panel { padding: 20px 0 24px; } .login-intro { margin: 24px 0 18px; } .login-form label { margin-top: 6px; } .login-form input { height: 44px; } .login-form button { height: 46px; margin-top: 12px; } .back-link { margin-top: 18px; } .login-aside { display: none; } }
</style>