import parameterization from '../../modules/parameterizations/routes';
import restaurants from '../../modules/restaurants/routes';
import coupons from '../../modules/coupons/routes';
import promotions from '../../modules/promotions/routes';
import order from '../../modules/orders/routes';

export default [
    {
        path: '/',
        name: 'home',
        component: () => import('../components/home.vue')
    },
    ...parameterization,
    ...restaurants,
    ...coupons,
    ...promotions,
    ...order
]

