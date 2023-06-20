<template>
    <section class="w-50">
        <header class="h-80px border-end border-bottom p-3">
            <div class="d-flex j-between">
                <div>
                    <p class="f-18 f-medium">Compra hoy!</p>
                    <p class="f-12 text-grey-lightest">Cupon activo</p>
                </div>
                <i class="icon-dots-vertical f-25" />
            </div>
        </header>
        <div class="border-end px-3 pt-3 f-16 d-flex flex-column gap-3 overflow-auto hidden-scroll h-100" style="padding-bottom: 100px;">
            <template v-for="(data, index) in datasValue" :key="index">
                <p class="f-bold">{{ data.title }}</p>
                <main>
                    <p v-if="data.subtitleOne" class="f-semibold">{{ data.subtitleOne }}</p>
                    <p v-if="data.textContentOne" class="f-light">{{ data.textContentOne }}</p>
                    <template v-for="(content, i) in data.sub" :key="i">
                        <div class="d-middle gap-2">
                            <p class="f-semibold">{{ content.subtitle }}</p>
                            <p class="f-light">{{ content.textContent }}</p>
                        </div>
                        <div class="d-middle flex-wrap my-1">
                            <template v-for="box in content.textContentBox" :key="box.id">
                                <p class="f-14 ps-2 pe-4 py-1 br-8 me-2 mb-2" style="border: 1px solid var(--blue-dark);">{{ box.content }}</p>
                            </template>
                            </div>
                    </template>
                </main>
            </template>
            <p class="f-14 f-light text-whitesmoke2">Cupón creado 21 de julio de 2022, 14:30 por <span class="text-grey">Jaime</span></p>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter()

const datasValue = ref([
    {
        id: 1,
        title: 'Datos generales',
        subtitleOne: 'Descripción de las condiciones:',
        textContentOne: '$10.000 para tus compras Ho con el cupón Hooyoct2022. Pide a tus restaurantes favoritos. Mín compra $30.000',
        sub: [
            {
                id: 1,
                subtitle: 'Aplicación de cupón:',
                textContent: 'Inmediato, cashback',
            },
            {
                id: 2,
                subtitle: 'Tipo de cupón:',
                textContent: '"oculto", "visible"',
            },
            {
                id: 3,
                subtitle: 'Código:',
                textContent: 'Hooyoct2022',
            }
        ],
    },
    {
        id: 2,
        title: 'Datos del descuento',
        subtitleOne: null,
        textContentOne: null,
        sub: [
            {
                id: 1,
                subtitle: 'Tipo de descuento:',
                textContent: 'Valor, porcentaje',
            },
            {
                id: 2,
                subtitle: 'Valor del descuento:',
                textContent: '$10.000',
            },
            {
                id: 3,
                subtitle: 'Porcentaje de descuento:',
                textContent: '15%',
            }
        ],
    },
    {
        id: 3,
        title: 'Datos de Datos de cashback',
        subtitleOne: null,
        textContentOne: null,
        sub: [
            {
                id: 1,
                subtitle: 'Tipo de descuento:',
                textContent: 'Valor, porcentaje',
            },
            {
                id: 2,
                subtitle: 'Valor del descuento:',
                textContent: '$10.000',
            },
            {
                id: 3,
                subtitle: 'Porcentaje de descuento:',
                textContent: '15%',
            }
        ],
    },
    {
        id: 4,
        title: 'Condiciones para aplicar al público',
        subtitleOne: null,
        textContentOne: null,
        sub: [
            {
                id: 1,
                subtitle: 'Órdenes solicitadas:',
                textContent: '10 - 100',
            },
            {
                id: 2,
                subtitle: 'Antigüedad:',
                textContent: '6 - 12 meses',
            },
            {
                id: 3,
                subtitle: 'Cupones usados:',
                textContent: '0 - 10',
            },
            {
                id: 4,
                subtitle: 'Edad:',
                textContent: '18 - 45',
            },
            {
                id: 5,
                subtitle: 'Valor de la última compra:',
                textContent: '$18.000 - $450.000',
            },
            {
                id: 6,
                subtitle: 'Fecha de última compra:',
                textContent: '7 ene 2022 - 2 oct 2022',
            },
            {
                id: 7,
                subtitle: 'Último acceso:',
                textContent: '3 - 5 días',
            },
            {
                id: 8,
                subtitle: 'Género:',
                textContent: 'Hombres, mujeres, otros',
            },
            {
                id: 9,
                subtitle: 'Ciudad:',
                textContentBox: [
                    {
                        id: 1,
                        content: 'todas'
                    },
                    {
                        id: 2,
                        content: 'Bucaramanga'
                    },
                    {
                        id: 3,
                        content: 'Barrancabermeja'
                    }
                ]
            }
        ],
    },
    {
        id: 5,
        title: 'Límites del cupón',
        subtitleOne: null,
        textContentOne: null,
        sub: [
            {
                id: 1,
                subtitle: 'Vigencia:',
                textContent: '3 oct 2022 - 3 ene 2023',
            },
            {
                id: 2,
                subtitle: 'Fecha inscripción restaurantes:',
                textContent: '3 oct 2022',
            },
            {
                id: 3,
                subtitle: 'Valor mínimo de compra:',
                textContent: '$30.000',
            },
            {
                id: 4,
                subtitle: 'Valor máx. de descuento:',
                textContent: '$100.000',
            }
        ],
    },
    {
        id: 6,
        title: 'Restaurantes',
        subtitleOne: null,
        textContentOne: null,
        sub: [
            {
                id: 1,
                subtitle: 'Etiquetas de restaurantes:',
                textContent: '""todas las categorías""',
                textContentBox: [
                    {
                        id: 1,
                        content: 'Picante'
                    },
                    {
                        id: 2,
                        content: 'Comida mexicana'
                    },
                    {
                        id: 3,
                        content: 'Tacos'
                    }
                ]
            },
        ],
    },
])

</script>

<style lang="scss" scoped>
</style>