export default [
    {
        path: '/ordenes/',
        name: 'orders.index',
        component: () => import('../pages/index.vue'),
        children: [
            {
                path: '',
                name: 'orders',
                component: () => import('../pages/orders.vue'),
                children: [
                    {
                        path: '13/orden/:id',
                        name: 'orders.actives',
                        component: () => import('../pages/ordersActives.vue')
                    }
                ]
            },
            {
                path: 'tablero',
                name: 'orders.board',
                component: () => import('../pages/ordenesTablero.vue')
            }
        ]
    }
]