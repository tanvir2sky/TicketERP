function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },
  { path: '/create-ticket', name: 'create-ticket', component: page('landingPage/create-ticket.vue') },
  { path: '/search-ticket', name: 'search-ticket', component: page('landingPage/search-ticket.vue') },
  { path: '/faq', name: 'faq', component: page('landingPage/faq.vue') },
 

  // { path: '/register', name: 'register', component: page('auth/register.vue') },
  // { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  // { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  // { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  // { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  // { path: '/home', name: 'home', component: page('home.vue') },
  // { path: '/settings',
  //   component: page('settings/index.vue'),
  //   children: [
  //     { path: '', redirect: { name: 'settings.profile' } },
  //     { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
  //     { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
  //   ] },
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/dashboard',
    component: page('dashboard/index.vue'),
    children: [
      { path: '', name: 'dashboard', component: page('dashboard/dashboard.vue') },
      { path: 'users', name: 'dashboard.users', component: page('dashboard/users.vue') },
      { path: 'ticket', name: 'dashboard.ticket', component: page('dashboard/tickets.vue') },
      { path: 'ticket/:id', name: 'dashboard.ticketInfo', component: page('dashboard/ticketInfo.vue') },
      { path: 'faq', name: 'dashboard.faq', component: page('dashboard/faq.vue') },
      { path: 'category', name: 'dashboard.category', component: page('dashboard/category.vue') },
      { path: 'priority', name: 'dashboard.priority', component: page('dashboard/priority.vue') },
      { path: 'setting', name: 'dashboard.setting', component: page('dashboard/setting.vue') },
      { path: 'profile', name: 'dashboard.profile', component: page('dashboard/profile.vue') },
      
    ] },

  { path: '*', component: page('errors/404.vue') }
]
