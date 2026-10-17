<script setup>
import { computed, onMounted, ref, watch } from 'vue';

const period = ref('daily');
const analytics = ref(null);
const isLoading = ref(true);
const error = ref('');
const periods = [
    { key: 'daily', label: 'Daily' },
    { key: 'weekly', label: 'Weekly' },
    { key: 'monthly', label: 'Monthly' },
];
const points = computed(() => {
    const values = analytics.value?.series ?? [];
    const max = Math.max(1, ...values.map((item) => Number(item.views)));

    return values.map((item, index) => ({
        ...item,
        x: values.length === 1 ? 380 : 34 + (index * 692) / (values.length - 1),
        y: 174 - (Number(item.views) / max) * 140,
    }));
});
const chartLine = computed(() => points.value.map((point) => `${point.x},${point.y}`).join(' '));
const chartArea = computed(() => points.value.length ? `34,184 ${chartLine.value} 726,184` : '34,184 726,184');
const maxViews = computed(() => Math.max(1, ...(analytics.value?.series ?? []).map((item) => Number(item.views))));
const formattedDate = new Intl.DateTimeFormat('en', { month: 'short', day: 'numeric', year: 'numeric' }).format(new Date());

async function loadAnalytics() {
    isLoading.value = true;
    error.value = '';

    try {
        const response = await fetch(`/admin/analytics/data?period=${period.value}`, {
            headers: { Accept: 'application/json' },
        });

        if (response.status === 401 || response.redirected) {
            window.location.assign('/admin/login');
            return;
        }

        if (!response.ok) {
            throw new Error('Analytics could not be loaded. Please refresh the page.');
        }

        analytics.value = await response.json();
    } catch (loadError) {
        error.value = loadError.message;
    } finally {
        isLoading.value = false;
    }
}

async function signOut() {
    try {
        await fetch('/admin/logout', {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
            },
        });
    } finally {
        window.location.assign('/admin/login');
    }
}

onMounted(loadAnalytics);
watch(period, loadAnalytics);
</script>

<template>
    <div class="analytics-shell">
        <aside class="sidebar">
            <a class="brand" href="/" aria-label="Swetha portfolio home"><span class="brand-mark">S</span><span>swetha<span class="brand-dot">.</span></span></a>
            <div class="sidebar-caption">WORKSPACE</div>
            <nav aria-label="Admin navigation">
                <a class="nav-item nav-active" href="/admin/analytics" aria-current="page">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="8" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="15" width="7" height="6" rx="1.5"/></svg><span>Analytics</span>
                </a>
                <a class="nav-item" href="/" target="_blank" rel="noreferrer"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 3h7v7M10 14 21 3M19 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6"/></svg><span>View portfolio</span></a>
            </nav>
            <div class="sidebar-bottom">
                <div class="privacy-note"><span class="privacy-dot"></span><span>Private analytics<br><small>Only you can see this</small></span></div>
                <button class="logout-button" type="button" title="Sign out" aria-label="Sign out" @click="signOut"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17l5-5-5-5M15 12H3m9-8h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-6"/></svg></button>
            </div>
        </aside>

        <main class="dashboard-main">
            <header class="topbar"><div class="breadcrumb"><span>Workspace</span><span class="breadcrumb-slash">/</span><strong>Analytics</strong></div><div class="topbar-right"><span class="live-indicator"><i></i> Tracking active</span><span class="avatar">S</span></div></header>
            <div class="dashboard-content">
                <section class="page-heading">
                    <div><p class="overline">PORTFOLIO OVERVIEW <span>·</span> {{ formattedDate }}</p><h1>Visitor analytics</h1><p class="heading-subtitle">A closer look at who's finding your work.</p></div>
                    <div class="page-heading-actions">
                        <div class="period-switch" role="group" aria-label="Analytics reporting period"><button v-for="item in periods" :key="item.key" type="button" :class="{ selected: period === item.key }" :aria-pressed="period === item.key" @click="period = item.key">{{ item.label }}</button></div>
                        <button class="refresh-button" type="button" title="Refresh analytics" aria-label="Refresh analytics" :disabled="isLoading" @click="loadAnalytics"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 7v5h-5M4 17v-5h5M5.6 9A7 7 0 0 1 18 6l2 6M4 12l2 6a7 7 0 0 0 12.4-3"/></svg></button>
                    </div>
                </section>
                <div v-if="error" class="error-banner" role="alert"><span>{{ error }}</span><button type="button" @click="loadAnalytics">Retry</button></div>

                <section class="stats-grid" aria-label="Visitor statistics">
                    <article class="stat-card stat-violet">
                        <div class="stat-heading"><span>Total visitors</span><span class="stat-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM20 8v6m3-3h-6"/></svg></span></div>
                        <div class="stat-value">{{ isLoading ? '—' : analytics?.visitors?.toLocaleString() ?? '0' }}</div><div class="stat-foot"><span>Unique tab sessions · approximate</span><span class="stat-mark">↗</span></div>
                    </article>
                    <article class="stat-card stat-blue">
                        <div class="stat-heading"><span>Page views</span><span class="stat-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></span></div>
                        <div class="stat-value">{{ isLoading ? '—' : analytics?.pageViews?.toLocaleString() ?? '0' }}</div><div class="stat-foot"><span>Across your portfolio</span><span class="stat-mark">◉</span></div>
                    </article>
                    <article class="stat-card stat-green">
                        <div class="stat-heading"><span>Visitor locations</span><span class="stat-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg></span></div>
                        <div class="stat-value">{{ isLoading ? '—' : analytics?.locationsAvailable ? analytics.locationCount.toLocaleString() : '—' }}</div><div class="stat-foot"><span>{{ analytics?.locationsAvailable ? 'Countries represented' : 'Not available yet' }}</span><span class="stat-mark">⌖</span></div>
                    </article>
                </section>

                <section class="chart-panel" aria-labelledby="trend-title">
                    <div class="panel-heading"><div><h2 id="trend-title">Visit activity</h2><p>Page views over time</p></div></div>
                    <div class="chart-legend"><span class="legend-dot"></span> Page views <span class="chart-total">{{ analytics?.pageViews?.toLocaleString() ?? '0' }} total</span></div>
                    <div class="chart-wrap"><div class="y-axis"><span>{{ maxViews }}</span><span>{{ Math.ceil(maxViews * .66) }}</span><span>{{ Math.ceil(maxViews * .33) }}</span><span>0</span></div>
                        <svg class="activity-chart" viewBox="0 0 760 210" preserveAspectRatio="none" role="img" aria-label="Page views trend chart">
                            <defs><linearGradient id="chart-fill" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#7768e8" stop-opacity=".18"/><stop offset="100%" stop-color="#7768e8" stop-opacity="0"/></linearGradient></defs>
                            <line v-for="y in [34, 80, 126, 184]" :key="y" x1="34" :y1="y" x2="726" :y2="y" class="chart-grid"/><polygon :points="chartArea" fill="url(#chart-fill)"/><polyline v-if="points.length > 1" :points="chartLine" class="chart-stroke"/><circle v-for="(point, index) in points" :key="`${point.label}-${index}`" :cx="point.x" :cy="point.y" r="3.5" class="chart-point"/>
                        </svg>
                    </div>
                    <div class="x-axis"><span v-for="(point, index) in points" v-show="index === 0 || index === points.length - 1 || index === Math.floor(points.length / 2)" :key="`${point.label}-${index}`">{{ point.label }}</span></div>
                    <div v-if="!isLoading && analytics?.pageViews === 0" class="empty-chart">Your visit trend will appear here as people explore your portfolio.</div>
                </section>

                <section class="details-grid">
                    <article class="detail-panel"><div class="panel-heading detail-heading"><div><h2>Popular pages</h2><p>Views by portfolio section</p></div><span class="panel-icon blue-icon">↗</span></div>
                        <div v-if="!isLoading && !analytics?.pages?.length" class="empty-list">No page views recorded yet.</div>
                        <div v-for="page in analytics?.pages ?? []" :key="page.page" class="data-row"><span class="row-label"><i class="page-dot" :class="`dot-${page.page}`"></i>{{ page.page.charAt(0).toUpperCase() + page.page.slice(1) }}</span><span class="row-value">{{ Number(page.views).toLocaleString() }} <small>views</small></span></div>
                        <div v-if="isLoading" class="empty-list">Loading page data...</div>
                    </article>
                    <article class="detail-panel"><div class="panel-heading detail-heading"><div><h2>Traffic sources</h2><p>Where visitors came from</p></div><span class="panel-icon violet-icon">⌁</span></div>
                        <div v-if="!isLoading && !analytics?.sources?.length" class="empty-list">Traffic source data will appear here.</div>
                        <div v-for="(source, index) in analytics?.sources ?? []" :key="source.source" class="source-row"><span class="source-rank">0{{ index + 1 }}</span><span class="source-name">{{ source.source }}</span><span class="source-views">{{ Number(source.views).toLocaleString() }}</span></div>
                        <div v-if="isLoading" class="empty-list">Loading source data...</div>
                    </article>
                    <article class="detail-panel"><div class="panel-heading detail-heading"><div><h2>Visitor locations</h2><p>Approximate country data</p></div><span class="panel-icon green-icon">⌖</span></div>
                        <div v-if="!isLoading && !analytics?.locations?.length" class="empty-list">Location data is unavailable until a country lookup is configured.</div>
                        <div v-for="location in analytics?.locations ?? []" :key="location.country" class="source-row"><span class="location-flag">{{ location.country }}</span><span class="source-name">{{ location.country }}</span><span class="source-views">{{ Number(location.visitors).toLocaleString() }}</span></div>
                        <div v-if="isLoading" class="empty-list">Loading location data...</div>
                    </article>
                </section>
                <footer class="dashboard-footer"><span>PRIVATE ADMIN DASHBOARD</span><span>Visitor IDs are session-only · No IP addresses stored</span></footer>
            </div>
        </main>
    </div>
</template>

<style scoped>
.analytics-shell { --ink: #26283a; min-height: 100vh; display: grid; grid-template-columns: 228px minmax(0, 1fr); background: #f7f8fb; color: var(--ink); font-family: 'DM Sans', sans-serif; }
.sidebar { position: sticky; top: 0; display: flex; height: 100vh; flex-direction: column; box-sizing: border-box; padding: 25px 15px 20px; border-right: 1px solid #ececf2; background: #fff; }
.brand { display: flex; align-items: center; gap: 10px; padding: 0 8px; color: var(--ink); font-size: 17px; font-weight: 700; text-decoration: none; }
.brand-mark { display: grid; width: 34px; aspect-ratio: 1; place-items: center; border-radius: 10px; background: linear-gradient(145deg, #7a67ef, #4a73d5); color: #fff; font-family: 'Playfair Display', serif; font-size: 18px; }
.brand-dot { color: #6d5be8; }
.sidebar-caption { margin: 48px 10px 13px; color: #a2a4b2; font-size: 9px; font-weight: 700; letter-spacing: 1.3px; }
.sidebar nav { display: grid; gap: 5px; }
.nav-item { display: flex; height: 40px; align-items: center; gap: 11px; padding: 0 11px; border-radius: 7px; color: #777a8d; font-size: 12px; font-weight: 600; text-decoration: none; transition: background .18s, color .18s; }
.nav-item:hover { background: #f5f5fb; color: #46405e; }
.nav-item svg, .logout-button svg, .refresh-button svg { width: 17px; height: 17px; fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.7; }
.nav-item:first-child svg rect { fill: currentColor; fill-opacity: .08; }
.nav-active { background: #f0effb; color: #6354d3; }
.sidebar-bottom { display: flex; align-items: center; justify-content: space-between; margin-top: auto; padding: 14px 4px 2px; border-top: 1px solid #f0f0f4; }
.privacy-note { display: flex; align-items: center; gap: 9px; color: #4e5264; font-size: 10px; font-weight: 700; line-height: 1.5; }
.privacy-note small { color: #999bab; font-size: 9px; font-weight: 400; }
.privacy-dot, .live-indicator i { width: 7px; height: 7px; flex: 0 0 auto; border-radius: 50%; background: #53b68e; box-shadow: 0 0 0 3px #53b68e1c; }
.logout-button, .refresh-button { display: grid; width: 34px; aspect-ratio: 1; place-items: center; border: 1px solid #e9eaf1; border-radius: 8px; background: #fff; color: #777a8d; cursor: pointer; transition: .2s; }
.logout-button:hover, .refresh-button:hover:not(:disabled) { border-color: #c7c3ec; background: #f8f7ff; color: #6254d4; }
.dashboard-main { min-width: 0; }
.topbar { display: flex; height: 65px; align-items: center; justify-content: space-between; padding: 0 38px; border-bottom: 1px solid #ececf2; background: #fff; }
.breadcrumb { display: flex; align-items: center; gap: 10px; color: #a1a3b1; font-size: 11px; }
.breadcrumb-slash { color: #d2d3dc; }
.breadcrumb strong { color: #4b4d5e; font-weight: 600; }
.topbar-right { display: flex; align-items: center; gap: 17px; }
.live-indicator { display: flex; align-items: center; gap: 8px; color: #6d7280; font-size: 10px; }
.live-indicator i { width: 6px; height: 6px; }
.avatar { display: grid; width: 29px; aspect-ratio: 1; place-items: center; border: 1px solid #e8e5fb; border-radius: 50%; background: #f2f0ff; color: #6557cf; font-size: 11px; font-weight: 700; }
.dashboard-content { width: min(1060px, calc(100% - 76px)); margin: 0 auto; padding: 35px 0 24px; }
.page-heading { display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; }
.page-heading-actions { display: flex; align-items: center; gap: 10px; }
.overline { margin: 0 0 9px; color: #9698a8; font-size: 9px; font-weight: 700; letter-spacing: 1.15px; }
.overline span { padding: 0 4px; color: #c2c3ce; }
.page-heading h1 { margin: 0; color: #292b3c; font-size: 27px; font-weight: 700; letter-spacing: 0; }
.heading-subtitle { margin: 7px 0 0; color: #888b9b; font-size: 12px; }
.refresh-button { width: 36px; }
.refresh-button:disabled svg { animation: spin 1s linear infinite; }
.error-banner { display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px; padding: 12px 14px; border: 1px solid #f2c9cf; border-radius: 7px; background: #fff6f6; color: #a93648; font-size: 11px; }
.error-banner button { border: 0; background: none; color: inherit; font: inherit; font-weight: 700; cursor: pointer; }
.stats-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 15px; }
.stat-card, .chart-panel, .detail-panel { border: 1px solid #e9eaf1; border-radius: 9px; background: #fff; box-shadow: 0 4px 16px #252a4306; }
.stat-card { position: relative; min-height: 126px; box-sizing: border-box; padding: 17px 18px 14px; overflow: hidden; }
.stat-card::after { position: absolute; right: -17px; bottom: -24px; width: 92px; aspect-ratio: 1; border-radius: 50%; opacity: .55; content: ''; }
.stat-violet::after { background: radial-gradient(circle, #e9e5ff, transparent 70%); }
.stat-blue::after { background: radial-gradient(circle, #e2efff, transparent 70%); }
.stat-green::after { background: radial-gradient(circle, #e0f4ed, transparent 70%); }
.stat-heading, .stat-foot { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; }
.stat-heading { color: #6f7283; font-size: 11px; font-weight: 600; }
.stat-icon { display: grid; width: 29px; aspect-ratio: 1; place-items: center; border-radius: 8px; }
.stat-violet .stat-icon { background: #f0eeff; color: #7666df; }
.stat-blue .stat-icon { background: #eaf3ff; color: #4f87d0; }
.stat-green .stat-icon { background: #eaf7f1; color: #46a883; }
.stat-icon svg { width: 15px; height: 15px; fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.6; }
.stat-value { position: relative; z-index: 1; margin: 7px 0 8px; color: #292b3c; font-size: 28px; font-weight: 700; line-height: 1; animation: value-in .38s ease both; }
.stat-foot { color: #a0a2b1; font-size: 9px; }
.stat-mark { color: #a4a5b4; font-size: 13px; }
.chart-panel { margin-top: 16px; padding: 19px 20px 16px; }
.panel-heading { display: flex; align-items: center; justify-content: space-between; }
.panel-heading h2 { margin: 0; color: #383a4b; font-size: 13px; font-weight: 700; }
.panel-heading p { margin: 5px 0 0; color: #9a9cab; font-size: 10px; }
.period-switch { display: flex; padding: 3px; border: 1px solid #eeeff4; border-radius: 7px; background: #fafafd; }
.period-switch button { min-width: 53px; padding: 6px 8px; border: 0; border-radius: 5px; background: transparent; color: #9295a4; font: inherit; font-size: 9px; font-weight: 600; cursor: pointer; }
.period-switch button.selected { background: #fff; color: #6254d4; box-shadow: 0 1px 4px #34345c14; }
.chart-legend { display: flex; align-items: center; gap: 7px; margin-top: 22px; color: #7e8192; font-size: 9px; }
.legend-dot { width: 7px; height: 7px; border-radius: 50%; background: #7666df; }
.chart-total { margin-left: auto; color: #9b9dac; }
.chart-wrap { display: grid; grid-template-columns: 26px minmax(0, 1fr); gap: 5px; height: 155px; margin-top: 8px; }
.y-axis { display: flex; flex-direction: column; justify-content: space-between; padding: 4px 0 15px; color: #b0b2bf; font-size: 8px; text-align: right; }
.activity-chart { width: 100%; height: 155px; overflow: visible; }
.chart-grid { stroke: #f0f0f5; stroke-dasharray: 3 4; stroke-width: 1; }
.chart-stroke { fill: none; stroke: #7464e1; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2.2; vector-effect: non-scaling-stroke; }
.chart-point { fill: #fff; stroke: #7464e1; stroke-width: 2; vector-effect: non-scaling-stroke; }
.x-axis { display: flex; justify-content: space-between; margin: -1px 3px 0 31px; color: #a7a9b5; font-size: 8px; }
.empty-chart { margin-top: 10px; color: #9b9dac; font-size: 10px; text-align: center; }
.details-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 15px; margin-top: 15px; }
.detail-panel { min-height: 179px; padding: 17px 18px 12px; }
.detail-heading { margin-bottom: 12px; }
.panel-icon { display: grid; width: 26px; aspect-ratio: 1; place-items: center; border-radius: 7px; font-size: 14px; }
.blue-icon { background: #edf4ff; color: #5385ce; }
.violet-icon { background: #f0eeff; color: #7261d8; }
.green-icon { background: #eaf7f1; color: #46a883; }
.data-row, .source-row { display: flex; min-height: 31px; align-items: center; justify-content: space-between; border-top: 1px solid #f2f2f6; font-size: 10px; }
.row-label { display: flex; align-items: center; gap: 9px; color: #626576; }
.page-dot { width: 7px; height: 7px; border-radius: 50%; background: #9c91ef; }
.dot-projects { background: #62a9d8; }
.dot-certificates { background: #61b99a; }
.dot-contact { background: #e6a36e; }
.row-value { color: #454858; font-weight: 700; }
.row-value small { color: #aaabb8; font-size: 8px; font-weight: 400; }
.source-row { justify-content: flex-start; gap: 10px; }
.source-rank, .location-flag { color: #aaaaba; font-size: 8px; }
.source-name { flex: 1; overflow: hidden; color: #626576; text-overflow: ellipsis; white-space: nowrap; }
.source-views { color: #454858; font-weight: 700; }
.empty-list { padding: 12px 0; color: #a0a2b0; font-size: 10px; }
.dashboard-footer { display: flex; justify-content: space-between; gap: 12px; margin-top: 18px; color: #a7a9b5; font-size: 8px; letter-spacing: .35px; }
@keyframes spin { to { transform: rotate(360deg); } }
@keyframes value-in { from { transform: translateY(4px); opacity: .35; } to { transform: translateY(0); opacity: 1; } }
@media (max-width: 1050px) { .analytics-shell { grid-template-columns: 190px minmax(0, 1fr); } .topbar { padding: 0 24px; } .dashboard-content { width: calc(100% - 48px); } .stats-grid { gap: 10px; } .stat-card { padding-right: 13px; padding-left: 13px; } .details-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 680px) {
    .analytics-shell { display: block; }
    .sidebar { position: static; width: 100%; height: 57px; flex-direction: row; align-items: center; justify-content: space-between; padding: 0 17px; border-right: 0; border-bottom: 1px solid #ececf2; }
    .brand { font-size: 15px; } .brand-mark { width: 29px; border-radius: 8px; font-size: 16px; }
    .sidebar-caption, .sidebar nav, .privacy-note { display: none; } .sidebar-bottom { margin: 0; padding: 0; border: 0; } .logout-button { width: 32px; }
    .topbar { height: 49px; padding: 0 17px; } .dashboard-content { width: calc(100% - 34px); padding-top: 27px; }
    .page-heading { align-items: flex-start; flex-direction: column; gap: 15px; margin-bottom: 20px; } .page-heading h1 { font-size: 24px; }
    .page-heading-actions { width: 100%; justify-content: space-between; }
    .stats-grid { grid-template-columns: 1fr 1fr; } .stat-card { min-height: 119px; } .stat-green { grid-column: 1 / -1; min-height: 105px; }
    .chart-panel { padding: 16px 13px 14px; } .period-switch button { min-width: 44px; padding-right: 5px; padding-left: 5px; }
    .details-grid { grid-template-columns: 1fr; } .detail-panel { min-height: auto; } .dashboard-footer { flex-direction: column; }
}
@media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; transition-duration: .01ms !important; } }
</style>