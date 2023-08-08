## Vue 3

#### Intalação do Vue 

- instalar o Vue via CDN porem é limitado
- instalar pelo cli recomendado
##
#### Input e data binding
- data binding, pode mudar o estado em tempo real do input que é recebido
##
#### CLI Vue
- criar e configurar projetos de mais avançada utilizando o Vue Router
```
    npm install -g @vue/cli
    vue -V
    vue create projet-vue
        - Manually select features
        - Babel
        - 3.x 
    npm run serve

```
##
#### Criando componentes
- components ajudam a dividir o layout evitando duplicacao de codigo, cada component tem sua responsabilidade e seu css
- estrutura basica
```
<template>
  <h1>Ola mundo</h1>
</template>

<script>
  export default {
    name: 'App'
  }
</script>
_________________________
IMPORTANDO COMPONENTE
_________________________
<template>
  <PrimeiroComponente />
</template>

<script>
  import PrimeiroComponente from './components/PrimeiroConponente.vue'
  export default {
    name: 'App',
    components: {
      PrimeiroComponente
    }
  }
</script>
```

##
#### Dados no componente
- os dados ficam em uma funcao chamada data, essa funcao retorna um objeto
- estrutura
```
<template>
  <div>
    <h1> Ola Vue</h1>
    <p>Meu nome é {{ name }} e trabalho como {{ work }}</p>
  </div>
</template>

<script>
export default {
  name: 'PrimeiroComponente',
  data() {
    return {
      name: "Marco",
      work: "Programador"
    }
  }
}
</script>
```

##
#### Lyfe cycle Hooks
- Lyfe cycle Hooks são eventos que podem ser ativados em determinadas partes do promgrama
```
<template>
<h1>Meu nome é: {{ name }}</h1>
</template>

<script>
  export default {
    name: 'LifeCycle',
    data() {
      return {
        name: 'hskjhdkjshdkjs'
      }
    },
    created() {
      this.name = 'Marco ANtonio'
    },
    mounted() {
      this.name = 'Santos'
    }
  }
</script>
```
##
#### Hierarquia de componentes
- componentes que dependen de componentes
- exemplo:
```
Form -> InputText -> Submit
```
##
#### Conhecendo as diretivas (v-if, v-show, v-for)
- as diretivas mudam parte do layout, baseada em condiçoes
```
<p v-if="esta_trabalhando">Estou trabalhando no momento</p>
<p v-else>Estou procurando trabalho!!!!</p>
<p v-show="mostrar_email">Mande uma mensagem para: {{ email }}</p>
<li v-for="fruta in frutas" :key="fruta.id">{{ fruta.nome }}</li>
```
##
#### Atributos dinâmicos (argumentos)
- Argumentos sao valores dinamicos que podem ser inseridos em:
    - diretivas: valores usados para executar um comportmaneto
    - atributos: url's, src de imagens, etc
```
      <p>Para acessar meu github <a v-bind:href="meu_link">Clique aqui</a> </p>
      <img :src="avatar" :alt="descricao">
```
##
#### Metodos
- metodos sao como funcoes que podem ser executadas em eventos ou logica
- eles ficam em um objeto methods
```
methods: {
    showEmail() {
      this.mostrar_email = !this.mostrar_email
      if (!this.mostrar_email) {
        this.texto_botao = 'MOstar E-mail'
      } else {
        this.texto_botao = 'Esconder E-mail'
      }
    }
  }
  
  <button @click="showEmail" >{{ texto_botao }}</button>
```
##
#### CSS Scoped e CSS global
- css global - se aplica todos os componentes
- css scoped - se aplica a um componente especifico
```
<style>
// global
  a {
    color: green;
  }

</style>
___________________________
<style scoped>
// global
  a {
    color: green;
  }

</style>
```
##
#### Renderização de listas (v-for)
- listas (array) sao renderizadas pela diretiva v-for
```
backend: ["php", "python", "JavaScript", "Java"],
<ul>
  <li v-for="(item, index) in backend" v-bind:key="index">{{ item }}</li>
</ul>
___________________________________________
frontend: [
  {id: 1, language: 'html'},
  {id: 2, language: 'css'},
  {id: 3, language: 'vue'}
]
<ul>
  <li v-for="(item) in frontend" v-bind:key="item.id">{{ item.language }}</li>
</ul>
```
##
#### Eventos (@submit e @click)
- Os eventos sao utilizados para realizar acoes do usuario com ativacao de metodos
- @click, @submit

##
#### Múltiplos eventos
- O vue permite executar multiplos eventos, a sintaxe é a mesma, porem é preciso separas os eventos por virgula isso permite executar dois metodos ou mais com um click
