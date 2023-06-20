/<template>
    <div class="d-flex gap-1">
        <el-tooltip :content="tooltipContentEdit" :placement="placementBottom" :effect="tooltipEffect">
            <div class="f-23 icon-hover-blue cr-pointer rounded-pill" @click="emit('removeIcons')">
                <i class="icon-editar" />
            </div>
        </el-tooltip>
        <el-tooltip v-if="showIconTwo" :content="tooltipContentRemove" :placement="placementBottom" :effect="tooltipEffect">
            <div class="f-23 icon-hover-blue cr-pointer rounded-pill" @click="emit('deleteTag')">
                <i :class="`icon-${iconNameRemove}`" />
            </div>
        </el-tooltip>
    </div>
</template>

<script setup>
defineProps({
    placementBottom:{
        type: String,
        default: 'bottom',
    },
    tooltipEffect:{
        type: String,
        default: 'light',
    },
    tooltipContentEdit:{
        type: String,
        default: 'Editar'
    },
    tooltipContentRemove:{
        type: String,
        default: 'Eliminar'
    },
    iconNameRemove: {
        type: String,
        default: 'eliminar',
        required: false
    },
    showIconTwo: {
        type: Boolean,
        required: false,
        default: true
    }
})

const emit = defineEmits(['removeIcons', 'deleteTag'])
</script>
