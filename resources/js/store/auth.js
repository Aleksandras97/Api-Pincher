import axios from 'axios'

const state = {
    token: null,
    user: null
}
//localStorage.getItem('access_token') || 

const getters = {
    authenticated(state) {
        return state.token  != null
    },
    authUser(state) {
        return state.user
    },
}

const mutations = {
    SET_TOKEN(state, token) {
        state.token = token
    },
    SET_USER(state, data) {
        state.user = data
    },
    
}

const actions = {

    async signIn ({ dispatch }, credentials) {
        let response = await axios.post('api/login', {
            username: credentials.username,
            password: credentials.password,
        })
        
        return dispatch('attempt', response.data.access_token)
    },

    async attempt ({ commit, state }, token) {
        if(token) {
            commit('SET_TOKEN', token)
        }

        if(!state.token){
            return
        }
        
        try {
            let response = await axios.get(`/api/logedinUser`)
            
            commit('SET_USER', response.data.data)
        } catch (error) {
            console.log('failed', error)
            commit('SET_TOKEN', null)
            commit('SET_USER', null)
        }
    },

    register(context, data) {

        return new Promise((resolve, reject) => {
            axios.post('api/register', {
                username: data.username,
                name: data.name,
                email: data.email,
                password: data.password,
            })
                .then(response =>  {
                    
                    resolve(response)
                })
                .catch(error => {
                        reject(error)
                    })
        })

    },
    
    signOut({ commit }){

        return axios.post('api/logout').then(() =>  {
        
            commit('SET_TOKEN', null)
            commit('SET_USER', null)
        })
    }
    
}

export const AuthModule = ({
    state,
    getters,
    mutations,
    actions
})