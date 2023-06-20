
export default [
    {
        path: '/parametrizacion/',
        name: 'parameterization',
        redirect: { name: 'parameterization.categories' },
        component: () => import('../pages/index.vue'),
        children: [
            {
                path: 'categorias',
                name: 'parameterization.categories',
                component: () => import('../modules/categoryRestaurant/pages/index.vue')
            },
            {
                path: 'etiquetasderestaurantes',
                name: 'parameterization.restaurantLabels',
                component: () => import('../modules/labelsRestaurant/pages/index.vue')
            },
            {
                path: 'planesdecomision',
                name: 'parameterization.comissionPlans',
                component: () => import('../modules/comissionPlans/pages/index.vue'),
            },
            {
                path: 'planesdecomision/crear_plan',
                name: 'parameterization.comissionPlans.createPlan',
                component: () => import('../modules/comissionPlans/pages/crearPlan.vue')
            },
            {
                path: 'planesdecomision/:id',
                name: 'parameterization.comissionPlans.editComissionPlans',
                component: () => import('../modules/comissionPlans/pages/crearPlan.vue')
            },
            {
                path: 'clasificaicon',
                name: 'parameterization.classification',
                component: () => import('../modules/classification/pages/index.vue')
            },
            {
                path: 'faqs-clientes',
                name: 'parameterization.faqsClients',
                redirect: { name: 'parameterization.faqsClients.frequentQuestions' },
                component: () => import('../modules/FAQsClients/pages/index.vue'),
                children: [
                    {
                        path: 'preguntasfrecuentes',
                        name: 'parameterization.faqsClients.frequentQuestions',
                        component: () => import('../modules/FAQsClients/pages/informationBox.vue')
                    },
                    {
                        path: 'terminos_y_condiciones',
                        name: 'parameterization.faqsClients.termsAndConditions',
                        component: () => import('../modules/FAQsClients/pages/termsAndConditions.vue')
                    }
                ]
            },
            {
                path: 'faqs-clientes/terminos_y_condiciones/editar/:id',
                name: 'parameterization.faqsClients.termsAndConditions.edit',
                component: () => import('../modules/FAQsClients/pages/editTermsAndConditions.vue')
            },
            {
                path: 'faqs-clientes/terminos_y_condiciones/crear',
                name: 'parameterization.faqsClients.termsAndConditions.create',
                component: () => import('../modules/FAQsClients/pages/editTermsAndConditions.vue')
            },
            {
                path: 'faqs-clientes/preguntasfrecuentes/crear/',
                name: 'parameterization.faqsClients.frequentQuestions.create',
                component: () => import('../modules/FAQsClients/pages/createQuestionBox.vue')
            },
            {
                path: 'faqs-clientes/preguntasfrecuentes/editar/:id',
                name: 'parameterization.faqsClients.frequentQuestions.edit',
                component: () => import('../modules/FAQsClients/pages/createQuestionBox.vue')
            }
        ]
    }
]