<template>
    <el-tooltip :content="tooltipContent" placement="bottom" effect="light">
        <div class="f-14 border-blue w-35px h-36px rounded-3 d-middle-center cr-default">
            <p>{{ useNumber }}</p>
        </div>
    </el-tooltip>
</template>

<script setup>
defineProps({
    useNumber: {
        type: Number,
        required: true
    },
    tooltipContent: {
        type: String,
        required: true
    }
})
</script>