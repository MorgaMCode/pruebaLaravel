<template>
    <div class="d-middle gap-4 mt-3">
        <buttonAction button-content="Crear grupo" @click="createGroup" />
        <buttonAction v-if="faqInformationBox.length" @click="createQuestion" button-content="Crear pregunta" />
    </div>
    <div class="mt-4" style="width: 602px;">
        <template v-if="faqInformationBox.length">
            <overviewInformationBox
                v-model="faqInformationBox"
                @removeInternalQuestions="openModalDelete"
                @seeEditGroup="createGroup"
                @seeRemoveGroup="removeGroup"
                @editInternalQuestions="(idPregunta) => openEditInternalQuestions(idPregunta)"
            />
        </template>
        <p v-else class="f-15">No hay grupos de preguntas creados</p>
        <modal ref="createGroupModal" modal-title="Crear grupo de preguntas">
            <modal-main input-name="Nombre del grupo" />
        </modal>
        <modal ref="editGroupModal" modal-title="Editar grupo de preguntas">
            <modalMain input-name="Nombre del grupo" input="Generales" />
        </modal>
        <modal
            ref="removeGroupModal"
            modal-title="Eliminar grupo"
            :modal-width="514"
            action="eliminar"
            @buttonAction="deleteGroup"
        >
            <main class="mx-3">
                <div class="border px-2 py-2 d-flex rounded-2 mb-4" style="background-color: #97A0B01C; border: 2px solid var(--whitesmoke) !important;">
                    <i class="icon-info-outline f-20" />
                    <p class="f-14 f-medium text-whitesmoke">Si eliminas este grupo, automáticamente se eliminarán todas las preguntas de este grupo.</p>
                </div>
                <p class="f-14">Esta acción es permanente. ¿Seguro de que quieres hacerlo?</p>
            </main>
        </modal>
        <modal
            ref="deleteQuestionModal"
            modal-title="Eliminar pregunta"
            action="Eliminar"
            @buttonAction="deleteQuestion"
        >
            <p class="f-14 px-3">Esta acción es permanente. ¿Seguro de que quieres hacerlo?</p>
        </modal>
    </div>
</template>

<script setup>
import buttonAction from '../../../../../shared/components/buttonAction.vue';
import modal from '../../../../../shared/components/modal.vue';
import modalMain from '../../../components/modalMain.vue';
import overviewInformationBox from '../components/overviewInformationBox.vue'
import { ref } from 'vue';
import { useRouter } from 'vue-router'

const createGroupModal = ref()
const editGroupModal = ref()
// Esta es la referencia que habre el modal de eliminar del cuadro general
const removeGroupModal = ref()
const deleteQuestionModal = ref()
const router = useRouter()
const indexBoxGroup = ref({})
const indexInternalQuestion = ref({})
const idi = ref()

const faqInformationBox = ref([
    {
        id: 1,
        img: '/img/trash/speaker.png',
        boxTitle: 'Información generales (2)',
        active: true,
        questions: [
            { id: 1, question: '¿Qué es Yap ?' },
            { id: 2, question: '¿Como puedo ser parte de hoy?' }
        ]
    },
    {
        id: 2,
        img: '/img/trash/question.png',
        boxTitle: 'Pedidos (3)',
        active: true,
        questions: [
            { id: 3, question: '¿Como puedo cancelar un pedido?' },
            { id: 4, question: '¿Que hago si tengo problemas con mi pedido?' },
            { id: 5, question: '¿Como realizo un pedido?' }
        ]
    }
])
// Funcion que abre el cuadro del modal de crear un grupo
function createGroup(){
    createGroupModal.value.open()
}

function editGroup(){
    editGroupModal.value.open()
}
function removeGroup(identificador){
    removeGroupModal.value.open()
    idi.value = identificador
}
function deleteGroup(){
    faqInformationBox.value = faqInformationBox.value.filter( e => e.id != idi.value )
    removeGroupModal.value.close()
}
function openModalDelete(indexGroup, indexQuestion){
    indexBoxGroup.value = indexGroup
    indexInternalQuestion.value = indexQuestion
    deleteQuestionModal.value.open()
}
function deleteQuestion(){
    faqInformationBox.value[indexBoxGroup.value].questions.splice(indexInternalQuestion.value, 1)
    deleteQuestionModal.value.close()
}
function openEditInternalQuestions(idQuestion){
    router.push({ name: 'parameterization.faqsClients.frequentQuestions.edit', params: { id: idQuestion } })
}
function createQuestion(){
    router.push({ name: 'parameterization.faqsClients.frequentQuestions.create' })
}

</script>

<style lang="scss" scoped>

</style>