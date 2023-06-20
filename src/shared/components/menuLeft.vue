<template>
    <div class="parent-menu-left hidden-scroll overflow-auto h-100 wf-64px box-shadow29 text-center py-4 d-middle flex-column gap-3">
        <router-list :list="icons" name-route="nameRoute">
            <template #default="{ item, selected }">
                <el-tooltip placement="right" effect="light">
                    <template #content>
                        <span :class="{ 'op-02': !item.active  }" >{{ item.content }}</span>
                    </template>
                        <div
                            class="f-25 item-with-hover rounded-circle text-grey wh-40 cr-pointer position-relative"
                            :class="{ 'selected': selected, 'op-02' : !item.active, 'mt-auto': item.id === 9 }"
                            @click="go(item.nameRoute)"
                        >
                            <i style="padding: 2px;" :class="item.name" >
                                <span
                                    v-if="item.notifications"
                                    class="position-absolute top-0 end-0 f-12 wh-17 bg-red-badge border border-white rounded-circle text-white d-middle-center"
                                >
                                    {{item.number}}
                                </span>
                            </i>
                        </div>
                </el-tooltip>
            </template>
        </router-list>
    </div>
</template>

<script setup>
import routerList from './routerList.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter()


const icons = ref([
    { id: 1, name: 'icon-home', content: 'incio', number: 5, active: true, notifications: false, nameRoute: 'home'},
    { id: 2, name: 'icon-holding', content: 'Holding' , number: 8, active: false, notifications: false},
    { id: 3, name: 'icon-restaurant', content: 'Restaurantes', number: 5, active: true, notifications: true, nameRoute: 'restaurant'},
    { id: 4, name: 'icon-promo', content: 'Promociones', number: 1, active: true, notifications: false, nameRoute: 'promotions'},
    { id: 5, name: 'icon-coupons', content: 'cupones', number: 3, active: true, notifications: false, nameRoute: 'coupons'},
    { id: 6, name: 'icon-story-plus', content: 'Historias', number: 9, active: false, notifications: false},
    { id: 7, name: 'icon-add-square', content: 'Lista', number: 2, active: false, notifications: false},
    { id: 8, name: 'icon-add-square', content: 'Lista', number: 1, active: false, notifications: false},
    { id: 8, name: 'icon-friends', content: 'Ordenes', number: 1, active: true, notifications: false, nameRoute: 'orders'},
    { id: 9, name: 'icon-parametrización', content: 'Parametrizaciones de los restaurantes', number: 1, active: true, notifications: false, nameRoute: 'parameterization'},
])

function go(nameRoute){
    router.push({ name: nameRoute })
}

</script>

<style scoped lang="scss">
.parent-menu-left{
    z-index: 2;
    .selected{
        background-color: var(--blue-state-lightest);
        color: var(--blue-mesage)
    }
}

</style>
