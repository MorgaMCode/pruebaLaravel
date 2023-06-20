export default [
    {
        path: '/cupones/grupos',
        name: 'coupons',
        component: () => import('../../coupons/pages/groups.vue')
    },
    {
        path: '/cupones/77',
        name: 'coupons.77',
        redirect: { name: 'coupons.77.main' },
        component: () => import('../../coupons/pages/seventySeven.vue'),
        children: [
            {
                path: '',
                name: 'coupons.77.main',
                component: () => import('../../coupons/pages/seventySevenMain.vue')
            },
            {
                path: 'estadisticas',
                name: 'coupons.77.main.statics',
                component: () => import('../../coupons/pages/statics.vue')
            },
            {
                path: 'restaurantes-participantes',
                name: 'coupons.77.main.participansRestaurants',
                component: () => import('../../coupons/pages/restaurantsParticipants.vue')
            }
        ]
    }
]