<template>
    <div class="p-5 w-100 overflow-auto hidden-scroll">
        <head class="d-middle gap-2">
            <el-tooltip content="Regresar" placement="bottom" effect="light">
                <div class="item-with-hover cr-pointer rounded-circle wh-36" @click="backRoute">
                    <i class="icon-chevron-left f-23" />
                </div>
            </el-tooltip>
            <h4 class="f-20 f-bold mb-0">{{ isEdit ? 'Crear' : 'Editar' }} pregunta</h4>
        </head>
        <main class="mt-5" style="margin-left: 40px;">
            <div class="ms-3">
                <h5 class="f-16 f-medium">Grupo</h5>
                <p class="f-14 mb-2">Selecciona el grupo del que hará parte esta pregunta</p>
            </div>
            <el-select v-model="selectValue" placeholder="Seleccionar" class="w-390px">
                <el-option
                    v-for="(item, i) in options"
                    :key="i"
                    :label="item.label"
                    :value="item.id"
                />
            </el-select>
            <div class="mt-4" style="width: 600px;">
                <main class="mb-4">
                    <p class="ms-3 f-16 f-medium">Pregunta</p>
                    <el-input v-model="model.question" placeholder="Escribe una pregunta" />
                </main>
                <main class="mb-4">
                    <p class="ms-3 f-16 f-medium">Respuesta</p>
                    <el-input type="textarea" v-model="model.answer" placeholder="Escribe una pregunta" :rows="5" />
                </main>
                <div class="d-middle-end gap-3">
                    <button @click="backRoute" class="w-140px h-36px rounded-3 text-grey bg-white f-14" style="border: 1px solid var(--gray-light)">Cerrar</button>
                    <button-action />
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import buttonAction from '../../../../../shared/components/buttonAction.vue';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const router = useRouter()
const route = useRoute()
const selectValue = ref('')
const questionValue = ref('')
const seeRouteQuestionId = ref(parseInt(route.params.id))
const informationBox = ref({})


const options = [
    {
        id: 1,
        label: 'Option 1'
    }
]

const isEdit = ref(route.name == 'parameterization.faqsClients.frequentQuestions.create')
const model = ref({
    id: 1,
    group: null,
    question: '',
    answer: ''
})

onMounted(() => {
    const routesInformationBox = [
        { id: 1, question: '¿Qué es Yap?', answer: 'Compañía que día tras día te facilita la vida. Una empresa que a ti como consumidor te brinda una mejor calidad de vida. Una mejor calidad de vida porque te regala tiempo para que lo compartas como quieras y con quien quieras, haciendo lo que en realidad disfrutas ¡porque sabemos que el tiempo es preciado y vale oro!' },
        { id: 2, question: '¿Como puedo ser parte de hoy?', answer: 'Compañía que día tras día te facilita la vida. Una empresa que a ti como consumidor te brinda una mejor calidad de vida. Una mejor calidad de vida porque te regala tiempo para que lo compartas como quieras y con quien quieras, haciendo lo que en realidad disfrutas ¡porque sabemos que el tiempo es preciado y vale oro!' },
        { id: 3, question: '¿Como puedo cancelar un pedido?', answer: 'Compañía que día tras día te facilita la vida. Una empresa que a ti como consumidor te brinda una mejor calidad de vida. Una mejor calidad de vida porque te regala tiempo para que lo compartas como quieras y con quien quieras, haciendo lo que en realidad disfrutas ¡porque sabemos que el tiempo es preciado y vale oro!' },
        { id: 4, question: '¿Que hago si tengo problemas con mi pedido?', answer: 'Compañía que día tras día te facilita la vida. Una empresa que a ti como consumidor te brinda una mejor calidad de vida. Una mejor calidad de vida porque te regala tiempo para que lo compartas como quieras y con quien quieras, haciendo lo que en realidad disfrutas ¡porque sabemos que el tiempo es preciado y vale oro!' },
        { id: 5, question: '¿Como realizo un pedido?', answer: 'Compañía que día tras día te facilita la vida. Una empresa que a ti como consumidor te brinda una mejor calidad de vida. Una mejor calidad de vida porque te regala tiempo para que lo compartas como quieras y con quien quieras, haciendo lo que en realidad disfrutas ¡porque sabemos que el tiempo es preciado y vale oro!' },
    ]
    informationBox.value = routesInformationBox.find(seeId => seeId.id === seeRouteQuestionId.value)
    if(!isEdit.value){
        model.value.question = informationBox.value.question
        model.value.answer = informationBox.value.answer
    }
})

function backRoute(){
    router.push({ name: 'parameterization.faqsClients' })
}
</script>

<style lang="scss" scoped>

</style>