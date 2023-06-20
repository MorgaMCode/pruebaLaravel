<template>
    <div class="w-50">
        <div class="h-80px border-bottom py-4 px-3">
            <p class="f-18 f-medium">Estadísticas generales del cupón</p>
        </div>
        <main class="ps-3 pe-5 pt-4 h-100 overflow-auto hidden-scroll" style="padding-bottom: 100px;">
            <div class="d-middle-bt box-shadowBoxTwo br-8 h-81px mb-2 ps-4 pe-5 py-3">
                <div>
                    <p class="f-16 f-light">Cupones aplicados</p>
                    <p class="f-22 f-semibold text-green-clear">520</p>
                </div>
                <div class="border mx-4 w-1px h-100" />
                <div>
                    <p class="f-16 f-light">Ventas</p>
                    <p class="f-22 f-semibold text-green-clear">$ 15.200.000</p>
                </div>
            </div>
            <cardPrices v-for="(coupon, i) in couponsData" :key="i" :data="coupon" @to-go-route="toGoList" />
            <div @click="toGoStatics" class="border d-middle gap-2 w-50 ms-auto br-8 p-1 h-36px blue-item cr-pointer">
                <i class="icon-statistics f-24" />
                <p class="f-14 f-medium">Ver más estadísticas</p>
            </div>
            <p class="f-16 f-semibold my-3">Planes del cupón</p>
            <card-plans v-for="(coupon, index) in couponsPlans" :key="index" :data="coupon" />
        </main>
    </div>
</template>

<script setup>
import cardPrices from '../components/cardPrices.vue';
import cardPlans from '../components/cardPlans.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter()

const couponsPlans = ref([
    {
        id: 1,
        image: '/img/trash/medalVip.png',
        title: 'VIP',
        objects: [
            {
                id: 1,
                icon: 'icon-coupons',
                amount: '50'
            },
            {
                id: 2,
                icon: 'icon-bill',
                amount: '$18.000'
            },
            {
                id: 3,
                icon: 'icon-exchange',
                amount: '0,8'
            },
            {
                id: 4,
                icon: 'icon-restaurant',
                amount: '2'
            }
        ]
    },
    {
        id: 2,
        objects: [
            {
                id: 1,
                icon: 'icon-coupons',
                amount: '65'
            },
            {
                id: 2,
                icon: 'icon-bill',
                amount: '$25.000'
            },
            {
                id: 3,
                icon: 'icon-exchange',
                amount: '0,5'
            },
            {
                id: 4,
                icon: 'icon-restaurant',
                amount: '1'
            }
        ]
    },
    {
        id: 3,
        objects: [
            {
                id: 1,
                icon: 'icon-coupons',
                amount: '100'
            },
            {
                id: 2,
                icon: 'icon-bill',
                amount: '$40.000'
            },
            {
                id: 3,
                icon: 'icon-exchange',
                amount: '0,3'
            },
            {
                id: 4,
                icon: 'icon-restaurant',
                amount: '0'
            }
        ]
    },
    {
        id: 4,
        image: '/img/trash/medalGold.png',
        title: 'Gold',
        objects: [
            {
                id: 1,
                icon: 'icon-coupons',
                amount: '30'
            },
            {
                id: 2,
                icon: 'icon-bill',
                amount: '$25.000'
            },
            {
                id: 3,
                icon: 'icon-exchange',
                amount: '0,8'
            },
            {
                id: 4,
                icon: 'icon-restaurant',
                amount: '1'
            }
        ]
    },
    {
        id: 5,
        objects: [
            {
                id: 1,
                icon: 'icon-coupons',
                amount: '50'
            },
            {
                id: 2,
                icon: 'icon-bill',
                amount: '$35.000'
            },
            {
                id: 3,
                icon: 'icon-exchange',
                amount: '0,5'
            },
            {
                id: 4,
                icon: 'icon-restaurant',
                amount: '1'
            }
        ]
    },
    {
        id: 6,
        image: '/img/trash/medalSilver.png',
        title: 'Silver',
        objects: [
            {
                id: 1,
                icon: 'icon-coupons',
                amount: '20'
            },
            {
                id: 2,
                icon: 'icon-bill',
                amount: '$20.000'
            },
            {
                id: 3,
                icon: 'icon-exchange',
                amount: '0,5'
            },
            {
                id: 4,
                icon: 'icon-restaurant',
                amount: '0'
            }
        ]
    },
])

const couponsData = ref([
    {
        id: 1,
        image: '/img/trash/gift.png',
        content: 'Valor obsequiado',
        price: '$520.000',
    },
    {
        id: 2,
        image: '/img/trash/users.png',
        content: 'Clientes que reclamaron el cashback',
        price: '30',
    },
    {
        id: 3,
        image: '/img/trash/users.png',
        content: 'Clientes que compraron',
        price: '420',
    },
    {
        id: 4,
        image: '/img/trash/coupons.png',
        content: 'Cupones aplicados la última semana',
        price: '25',
    },
    {
        id: 5,
        image: '/img/trash/restaurants.png',
        content: 'Restaurantes participantes',
        price: '5',
        seeList: true
    }
])
function toGoStatics(){
    router.push({ name: 'coupons.77.main.statics' })
}

function toGoList(){
    router.push({ name: 'coupons.77.main.participansRestaurants' })
}


</script>

<style lang="scss" scoped>

</style>