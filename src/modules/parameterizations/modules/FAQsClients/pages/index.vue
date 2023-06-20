<template>
    <div class="p-5 overflow-auto hidden-scroll">
        <info-top-config
            subtitle="FAQs clientes"
            description="Preguntas que surgen comúnmente en un contexto determinado y sobre un tema específico. Estas preguntas se agrupan y contiene la respuesta a estos interrogantes, de una manera clara y completa."
        >
            <template #default>
                <div class="pt-2 pb-3 d-flex flex-wrap gap-3">
                    <router-list :list="routesTop" nameRoute="routeName">
                        <template #default="{ item, selected }">
                            <div
                                class="hover-route px-4 py-2 rounded-2 bg-blue-lightest cr-pointer"
                                :class="{ 'div-router': selected }"
                                @click="selectedRoute(item.routeName)"
                            >
                                <p class="text-grey-light f-14">{{ item.name }}</p>
                            </div>
                        </template>
                    </router-list>
                </div>
            </template>
        </info-top-config>
        <div class="d-middle ms-2 my-2">
            <i class="icon-info-outline f-23" />
            <p>Los datos que se modifiquen en este ítem, se mostrarán tanto a restaurantes como a comercios</p>
        </div>
        <router-view />
    </div>
</template>

<script setup>
import infoTopConfig from '../../../../../shared/components/infoTopConfig.vue';
import routerList from '../../../../../shared/components/routerList.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter()

const routesTop = ref([
    { id: 1, name: 'Motivos de soporte' },
    { id: 2, name: 'Preguntas frecuentes', routeName: 'parameterization.faqsClients.frequentQuestions' },
    { id: 3, name: 'T&C', routeName: 'parameterization.faqsClients.termsAndConditions' },
    { id: 4, name: 'Políticas de privacidad' }
])

function selectedRoute(route){
    router.push({ name : route })
}

</script>

<style lang="scss" scoped>
.hover-route{
    &:hover{
        background-color: var(--gray-light) !important;
    }
    &.div-router{
        background-color: var(--blue-state-lightest) !important;
        p{
            color: var(--blue-state) !important;
        }
    }
}

</style>