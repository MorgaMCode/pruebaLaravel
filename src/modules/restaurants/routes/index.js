export default [
    {
        path: '/restaurantes',
        name: 'restaurant',
        redirect: { name: 'restaurant.requests.list' },
        component: () => import('../../restaurants/pages/index.vue'),
        children: [
            {
                path: 'solicitudes',
                name: 'restaurant.requests',
                redirect: { name: 'restaurant.requests.list' },
                component: () => import('../../restaurants/pages/requests.vue'),
                children: [
                    {
                        path: 'lista',
                        name: 'restaurant.requests.list',
                        component: () => import('../../restaurants/pages/list.vue'),
                    },
                    {
                        path: 'mosaico',
                        name: 'restaurant.requests.mosaic',
                        component: () => import('../../restaurants/pages/mosaic.vue')
                    }
                ]
            },
            {
                path: 'activos',
                name: 'restaurant.actives',
                component: () => import('../../restaurants/pages/actives.vue')
            },
            {
                path: 'inactivos',
                name: 'restaurant.inactives',
                component: () => import('../../restaurants/pages/inactives.vue')
            }
        ]
    },
    {
        path: '/restaurantes/:id',
        name: 'restaurant.seventySeven',
        redirect: { name: 'restaurant.seventySeven.stores' },
        component: () => import('../../restaurants/pages/restaurant77.vue'),
        children: [
            {
                path: 'tiendas/',
                name: 'restaurant.seventySeven.stores',
                component: () => import('../../restaurants/pages/restaurantStores.vue'),
            },
            {
                path: 'historial',
                name: 'restaurant.seventySeven.stores.history',
                component: () => import('../../restaurants/pages/historyRestaurant.vue')
            },
            {
                path: 'tiendas/:idStore',
                name: 'restaurant.seventySeven.stores.historyInformation',
                redirect: { name: 'restaurant.seventySeven.stores.history.informacion' },
                component: () => import('../pages/shopOverwiew.vue'),
                children: [
                    {
                        path: 'informacion',
                        name: 'restaurant.seventySeven.stores.history.informacion',
                        component: () => import('../pages/informationTableStore.vue')
                    },
                    {
                        path: 'tipos_entrega/',
                        name: 'restaurant.seventySeven.stores.history.delivery.types',
                        component: () => import('../pages/storesDeliveryTypes.vue')
                    },
                    {
                        path: 'mesas/',
                        name: 'restaurant.seventySeven.stores.history.tables',
                        component: () => import('../pages/storesTables.vue')
                    },
                    {
                        path: 'perfil',
                        name: 'restaurant.seventySeven.stores.history.profile',
                        component: () => import('../pages/storeProfile.vue')
                    }
                ]
            },
            {
                path: 'tiendas/:idStore/historial_estados',
                name: 'restaurant.seventySeven.stores.stateHistory',
                component: () => import('../pages/historyStateRetaurant.vue')
            },
            {
                path: 'tiendas/:idStore/historial_actividad/',
                name: 'restaurant.seventySeven.stores.activityHistory',
                component: () => import('../pages/activityHistory.vue')
            }
        ]
    }
]