<template>
    <section class="w-100 overflow-auto hidden-scroll">
        <header class="mx-5 mt-5">
            <div class="d-middle-bt">
                <p class="f-28 f-bold">Cupones</p>
                <div class="d-flex gap-3">
                    <div class="br-8 border">
                        <p class="f-14 f-medium px-5 py-2">Cupones activos</p>
                    </div>
                    <div class="border br-8">
                        <i class="icon-historial f-24" />
                    </div>
                </div>
            </div>
            <div class="d-middle-bt mt-4">
                <div class="d-middle gap-4">
                    <p class="f-20 f-bold">Grupos de cupones</p>
                    <buttonAction  />
                </div>
                <div class="w-316px d-middle position-relative ms-auto">
                    <el-input v-model="search" placeholder="Buscar" />
                    <i class="icon-buscar position-absolute end-0 f-24 me-1" />
                </div>
            </div>
        </header>
        <el-table
            :data="tableData"
            style="width: 100%; cursor: pointer;"
            size="large"
            class="mt-4"
            header-cell-class-name="bg-blue-light-table"
            @row-click="goPage"
        >
            <el-table-column width="35" />
            <el-table-column sortable prop="name" label="Nombre" width="300" />
            <el-table-column sortable prop="coupons" label="Cupones" width="250" />
            <el-table-column sortable prop="activeCoupons" label="Cupones activos" width="280" />
            <el-table-column sortable prop="updateLast" label="Última actualización" width="370" />
            <el-table-column sortable prop="state" label="Estado" width="150" >
                <template #default="scope">
                    <el-tag
                        disable-transitions
                        :class="scope.row.state === 'Activo' ? 'stateActive' : 'stateInactive'"
                    >
                        {{ scope.row.state }}
                    </el-tag>
                </template>
            </el-table-column>
            <el-table-column>
                <template #default="scope">
                    <i class="icon-dots-vertical f-24" />
                </template>
            </el-table-column>
        </el-table>
    </section>
</template>

<script setup>
import buttonAction from '../../../shared/components/buttonAction.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const search = ref('')
const router = useRouter()

const tableData = [
    {
        name: 'Para los más fieles',
        coupons: 4,
        activeCoupons: 2,
        updateLast: '20 mar.2022',
        state: 'Activo'
    },
    {
        name: 'Clientes nuevos',
        coupons: 2,
        activeCoupons: 2,
        updateLast: '8 jun.2022',
        state: 'Activo'
    },
    {
        name: 'Activos en Hooy',
        coupons: 5,
        activeCoupons: 3,
        updateLast: '14 feb.2022',
        state: 'Inactivo'
    },
    {
        name: 'Rescatando clientes perdidos',
        coupons: 3,
        activeCoupons: 1,
        updateLast: '20 abr.2022',
        state: 'Activo'
    }
]

function goPage(){
    router.push({ name: 'coupons.77' })
}
</script>

<style lang="scss" scoped>
%decoration{
    font-size: 16px !important;
    background-color: transparent !important;
    border: none !important;
}
.stateActive{
    @extend %decoration;
    color: var(--green-clear) !important;
}
.stateInactive{
    @extend %decoration;
    color: var(--whitesmoke) !important;
}

</style>