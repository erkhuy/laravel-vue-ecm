import Dashboard from '../layouts/Dashboard.vue';
import Home from '../layouts/Home.vue';
import example from '../components/ExampleComponent.vue';
export const routers = [{
        path: '/admin',
        component: Dashboard,
        children: [{

                path: 'exmaple',
                component: example
            },
            {

                path: '/',
                component: Dashboard
            },

        ]
    },
    {
        path: '/',
        component: Home,
        children: [{

                path: 'exmaple',
                component: example
            },

        ]
    }

]