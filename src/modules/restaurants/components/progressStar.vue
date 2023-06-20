<template>
    <div class="d-middle">
        <p class="f-11 f-light text-whitesmoke">{{ calificationClassification.position }}</p>
        <i class="icon-star-outline f-14" />
        <el-progress
            :stroke-width="12"
            :percentage="(calificationClassification.percentage/10)*100"
            status="warning"
            class="w-100"
            :show-text="false"
        />
        <p class="f-10 f-light w-26px ms-1">({{ calificationClassification.percentage }})</p>
    </div>
</template>

<script setup>

const props = defineProps({
    calificationClassification:{
        type: Object,
        required: true
    }
})

</script>

<style lang="scss" scoped>

</style>