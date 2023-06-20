export default [
    {
        path: '/promociones',
        name: 'promotions',
        redirect: { name: 'promotions.groups' },
        component: () => import('../pages/promotions.vue'),
        children: [
            {
                path: 'grupos',
                name: 'promotions.groups',
                component: () => import('../pages/promotionsGroups.vue')
            },
            {
                path: 'historial',
                name: 'promotions.history',
                component: () => import('../pages/promotionsHistory.vue')
            },
            {
                path: 'promociones-activas',
                name: 'promotions.active.promotions',
                component: () => import('../pages/activePromotions.vue')
            },
            {
                path: ':id',
                name: 'promotions.groups.box',
                component: () => import('../pages/promotionsDinamicRoute.vue')
            }
        ]
    }
]