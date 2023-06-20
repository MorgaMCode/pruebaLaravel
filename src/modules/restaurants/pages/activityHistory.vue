<template>
    <section class="h-100 pb-5">
        <div class="d-middle px-3 h-65px gap-2" style="box-shadow: 0px 1px 2px var(--shadow);">
            <el-tooltip content="Regresar" placement="bottom" effect="light">
                <div class="cr-pointer icon-hover-blue rounded-circle wh-32 f-25 d-middle-center" @click="router.go(-1)">
                    <i class="icon-arrow-left" />
                </div>
            </el-tooltip>
            <h1 class="f-28 f-bold mb-0">Provenza</h1>
        </div>
        <div class="h-100 overflow-auto hidden-scroll px-4 pt-4 pb-5">
            <h2 class="f-medium f-20">Historial de actividad</h2>
            <p class="text-whitesmoke f-14">Compara los horarios de atención de tu tienda con los horarios de conexión de tus operarios.</p>
            <h3 class="f-medium f-20 my-4">Registro de la ultima semana</h3>
            <div class="ms-2" style="width: 537px;">
                <p>Hoy</p>
                <template v-for="(horario, i) in selectedDate" :key="i">
                    <div class="d-middle-bt pe-5 pb-2">
                        <p class="f-14">{{ horario.date }}</p>
                        <p class="lineDetail cr-pointer f-12" @click="seeDetails">Ver detalle</p>
                    </div>
                    <div class="ms-2">
                        <p class="f-12 text-whitesmoke">Horarios de atención</p>
                        <div class="d-middle-bt gap-2 mb-2">
                            <div class="h-20px w-100 border-gray-light rounded-pill justify-content-end d-flex gap-5 pe-4" style="box-shadow:inset 0px 3px 6px var(--shadow); padding: 1px;" >
                                <content-tooltip-activity-history>
                                    <div class="bg-green-clear w-90px h-100" style="border-radius: 10px;" />
                                </content-tooltip-activity-history>
                                <contentTooltipActivityHistory>
                                    <div class="bg-green-clear w-70px h-100" style="border-radius: 10px;" />
                                </contentTooltipActivityHistory>
                            </div>
                            <p class="f-12 text-whitesmoke w-90px text-start">{{ horario.horarios.horaAtencion }}</p>
                        </div>
                        <p class="f-12 text-whitesmoke">Horarios de conexión</p>
                        <div class="d-middle-bt gap-2 mb-2">
                            <div class="border-gray-light rounded-pill d-flex justify-content-end gap-5 pe-4 h-20px w-100" style="box-shadow:inset 0px 3px 6px var(--shadow); padding: 1px;" >
                                <div class="d-flex" style="gap: 2px;">
                                    <contentTooltipActivityHistory>
                                        <div class="bg-green-clear w-50px h-100" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;" />
                                    </contentTooltipActivityHistory>
                                    <contentTooltipActivityHistory>
                                        <div class="w-30px h-100" style="background-color: #4867df;" />
                                    </contentTooltipActivityHistory>
                                    <contentTooltipActivityHistory>
                                        <div class="bg-green-clear w-20px h-100" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" />
                                    </contentTooltipActivityHistory>
                                </div>
                                <contentTooltipActivityHistory>
                                    <div class="bg-green-clear w-60px h-100 rounded-pill" />
                                </contentTooltipActivityHistory>
                            </div>
                            <p class="f-12 text-whitesmoke w-90px text-start">{{ horario.horarios.horaConexion }}</p>
                        </div>
                        <p class="f-12 text-whitesmoke">Nivel de demanda</p>
                        <div class="d-middle-bt gap-2 mb-4">
                            <div class="h-20px position-relative border-gray-light rounded-pill d-flex" style="gap: 2px; width: calc(100% - 90px); box-shadow:inset 0px 3px 6px var(--shadow); padding: 1px;" >
                                <contentTooltipActivityHistory>
                                    <div class="w-60 h-100" style="background-color: var(--yellow-capsule); border-top-left-radius: 10px; border-bottom-left-radius: 10px;" />
                                </contentTooltipActivityHistory>
                                <contentTooltipActivityHistory>
                                    <div class="bg-orange-capsule w-20 h-100" />
                                </contentTooltipActivityHistory>
                                <contentTooltipActivityHistory>
                                    <div class="w-20 h-100" style="background-color: #ff6f6f;" />
                                </contentTooltipActivityHistory>
                                <contentTooltipActivityHistory>
                                    <div class="w-15 h-100" style="background-color: var(--yellow-capsule); border-top-right-radius: 10px; border-bottom-right-radius: 10px;" />
                                </contentTooltipActivityHistory>
                            </div>
                        </div>
                    </div>
                </template>
                <div>
                    <p class="f-medium f-20 m-3 mt-5">Filtrar historial</p>
                    <p class="f-medium ms-3 f-16">Selecciona una fecha</p>
                    <div class="d-middle-bt br-8 w-316px op-06 cr-pointer" style="border: 1px solid #DEE1E4;" @click="showDate">
                        <i class="icon-calendar-2 f-25" />
                        <el-date-picker
                            v-model="datePickeValue"
                            placeholder="Seleccionar fecha"
                            type="date"
                            size="large"
                            :clearable="false"
                            :editable="false"
                            ref="handle"
                            value-format="YYYY-MM-DD"
                            @visible-change="seeDate"
                        >
                            <template #rangeSeparator>
                                <p>Este es el rango separador</p>
                            </template>
                        </el-date-picker>
                        <i v-if="showIcon" class="icon-chevron-down f-25" />
                        <i v-else class="icon-chevron-up f-25" />
                    </div>
                    <template v-if="datePickeValue !== ''" v-for="(horario, i) in selectDate" :key="i">
                    <div class="d-middle-bt pe-5 pb-2 mt-4">
                        <p class="f-14">{{ datePickeValue }}</p>
                        <p class="f-12">Ver detalle</p>
                    </div>
                    <div class="ms-2">
                        <p class="f-12 text-whitesmoke">Horarios de atención</p>
                        <div class="d-middle-bt gap-2 mb-2">
                            <div class="h-20px w-100 border-gray-light rounded-pill justify-content-end d-flex gap-5 pe-4" style="box-shadow:inset 0px 3px 6px var(--shadow); padding: 1px;" >
                                <div class="bg-green-clear w-70px h-100" style="border-radius: 10px;" />
                                <div class="bg-green-clear w-90px h-100" style="border-radius: 10px;" />
                            </div>
                            <p class="f-12 text-whitesmoke w-90px text-start">{{ horario.horarios.horaAtencion }}</p>
                        </div>
                        <p class="f-12 text-whitesmoke">Horarios de conexión</p>
                        <div class="d-middle-bt gap-2 mb-2">
                            <div class="border-gray-light rounded-pill d-flex justify-content-end gap-5 pe-4 h-20px w-100" style="box-shadow:inset 0px 3px 6px var(--shadow); padding: 1px;" >
                                <div class="d-flex" style="gap: 2px;">
                                    <div class="bg-green-clear w-50px h-100" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;" />
                                    <div class="w-30px h-100" style="background-color: #4867df;" />
                                    <div class="bg-green-clear w-20px h-100" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;" />
                                </div>
                                <div class="bg-green-clear w-60px h-100 rounded-pill" />
                            </div>
                            <p class="f-12 text-whitesmoke w-90px text-start">{{ horario.horarios.horaConexion }}</p>
                        </div>
                        <p class="f-12 text-whitesmoke">Nivel de demanda</p>
                        <div class="d-middle-bt gap-2 mb-4">
                            <div class="h-20px position-relative border-gray-light rounded-pill d-flex" style="gap: 2px; width: calc(100% - 90px); box-shadow:inset 0px 3px 6px var(--shadow); padding: 1px;" >
                                <div class="w-60 h-100" style="background-color: var(--yellow-capsule); border-top-left-radius: 10px; border-bottom-left-radius: 10px;" />
                                <div class="bg-orange-capsule w-20 h-100" />
                                <div class="w-20 h-100" style="background-color: #ff6f6f;" />
                                <div class="w-15 h-100" style="background-color: var(--yellow-capsule); border-top-right-radius: 10px; border-bottom-right-radius: 10px;" />
                            </div>
                        </div>
                    </div>
                </template>
                </div>
            </div>
        </div>
    </section>
    <modal ref="SeeDetailsModal" :modalWidth="938" modalTitle="Historial de actividad" :seeButtonsBottom="false">
        <div class="px-3 py-2">
            <p class="f-medium f-18">Viernes, 21 Ago. 2022</p>
            <div class="ps-4 pt-3">
                <p class="f-medium f-16">Horario de atención</p>
                <el-table
                    :data="selectedDateTableAttention"
                    size="large"
                    style="width: 100%;"
                    header-cell-class-name="bg-blue-light-table f-16"
                >
                  <el-table-column label="Estado" sortable prop="state" width="195">
                    <template #default="scope">
                        <div class="d-middle justify-content-start el-tag w-177px" :class="[scope.row.state == 'Tienda abierta' ? 'stateGreen' : 'stateBlue']">
                            <i class="f-25" :class="[scope.row.state == 'Tienda abierta' ? 'icon-sun' : 'icon-cloud']" />
                            <p class="f-14">{{ scope.row.state }}</p>
                        </div>
                    </template>
                  </el-table-column>
                  <el-table-column label="Hora inicial" sortable prop="startTime" width="160" />
                  <el-table-column label="Hora final" sortable prop="endTime" width="160" />
                  <el-table-column label="Tiempo" sortable prop="time" width="" />
                </el-table>
                <p class="f-15">Tiempo total de atención: 8 h</p>

                <p class="f-medium pt-5 f-16">Horario de conexión</p>
                <el-table
                    :data="selectedDateTableConnection"
                    header-cell-class-name="bg-blue-light-table"
                    size="large"
                    style="width: 100%"
                >
                  <el-table-column label="Estado" sortable prop="state" width="195" >
                    <template #default="scope">
                        <div class="el-tag w-177px" :class="[scope.row.state == 'Tienda abierta' ? 'stateGreen' : 'stateBlue']">
                            <i class="f-25" :class="[scope.row.state == 'Tienda abierta' ? 'icon-sun' : 'icon-cloud']" />
                            <p class="f-14">{{ scope.row.state }}</p>
                        </div>
                    </template>
                  </el-table-column>
                  <el-table-column label="Hora inicial" sortable prop="startTime" width="160" />
                  <el-table-column label="Hora final" sortable prop="endTime" width="160" />
                  <el-table-column label="Responsable" sortable prop="responsible" width="200" />
                  <el-table-column label="Tiempo" sortable prop="startTime" />
                </el-table>
                <p class="f-medium f-15">Tiempo total de conexion: 7 h 40 min</p>
            </div>
        </div>
    </modal>
</template>

<script setup>
import modal from '../../../shared/components/modal.vue';
import contentTooltipActivityHistory from '../components/contentTooltipActivityHistory.vue';
import { useRoute, useRouter } from 'vue-router';
import { ref } from 'vue';

let router = useRouter()
const showIcon = ref(true)
const handle = ref()
const SeeDetailsModal = ref()


const datePickeValue = ref('')

let selectedDateTableAttention = [
    {
        id: 1,
        state: 'Tienda abierta',
        startTime: '11:00 am',
        endTime: '2:00 pm',
        time: '3 h',
    },
    {
        id: 2,
        state: 'Tienda en standby',
        startTime: '11:00 am',
        endTime: '2:00 pm',
        time: '3 h',
    }
]

let selectedDateTableConnection = [
    {
        id: 1,
        state: 'Tienda abierta',
        startTime: '9:00 pm',
        endTime: '12: 00 pm',
        responsible: 'Maria Ramona Castillo',
        time: '3 h'
    },
    {
        id: 2,
        state: 'Tienda en standby',
        startTime: '12:00 pm',
        endTime: '12: 00 pm',
        responsible: 'Maria Ramona Castillo',
        time: '20 m'
    },
    {
        id: 3,
        state: 'Tienda abierta',
        startTime: '12:00 pm',
        endTime: '2: 00 pm',
        responsible: 'Javier Andres Moreno',
        time: '1 h 40 min'
    },
    {
        id: 4,
        state: 'Tienda abierta',
        startTime: '8:00 pm',
        endTime: '11: 00 pm',
        responsible: 'Javier Andres Moreno',
        time: '3 h'
    }
]

let selectedDate = [
    {
        date: 'Viernes, 21 Ago. 2022',
        horarios: {
            horaAtencion: '9 hrs',
            horaConexion: '7 hrs 30 min',
        },
    },
    {
        date: 'Viernes, 21 Ago. 2022',
        horarios: {
            horaAtencion: '5 hrs',
            horaConexion: '0 hrs',
        },
    }
]

let selectDate = [
    {
        date: 'Viernes, 21 Ago. 2022',
        horarios: {
            horaAtencion: '9 hrs',
            horaConexion: '7 hrs'
        }
    }
]

function showDate(){
    showIcon.value ? handle.value.handleOpen() : handle.value.handleClose()
}

function seeDate(visible){
    visible ? showIcon.value = false : showIcon.value = true
}

function seeDetails(){
    SeeDetailsModal.value.open()
}

</script>

<style lang="scss" scoped>
%decoration{
    padding: 13px 10px 13px 1px;
    border-radius: 14px;
}
.stateGreen{
    @extend %decoration;
    color: var(--green-clear);
    border: 1px solid var(--green-clear);
}

.stateBlue{
    @extend %decoration;
    color: var(--blue-state);
    border: 1px solid var(--blue-state);
}
.lineDetail{
    transition: 0.3s all;
    &:hover{
        text-decoration: underline;
        color: var(--blue-state);
    }
}

</style>