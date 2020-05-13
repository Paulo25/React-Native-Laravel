import React, {Component} from 'react';
import {View, Text, TextInput, Image, Alert, ScrollView, FlatList, TouchableOpacity, StyleSheet} from 'react-native';
import api from '../services/api';

export default class Main extends Component{        
  constructor(props){
    super(props);
    this.state = {
      linguagens: [],
      search: '',
      vazio: 'Nenhuma Linguagem de programação encontrada...'
    }
  }

handleSearch = (text) => {
    this.setState({ search: text })
 }
 
search = async (search) => {
  //alert('search: ' + search)
  const response = await api.get('/linguagens-programacao/search/' + search);
  const {results} = response.data;
  console.log(results);
  if(Object.keys(results).length <= 0){
    this.setState({
      linguagens: ''
    });
    Alert.alert(this.state.vazio);
  }else{
    this.setState({
      linguagens: results
    });
  } 
} 

componentDidMount(){
  this.loadLinguagens();
}

loadLinguagens = async () => {
  const response = await api.get('/linguagens-programacao');
  const {results} = response.data;
  this.setState({
    linguagens: results
  });
}

renderItem = ({ item }) => (
  <View style={styles.clientContainer}>
  <Image style={styles.avatar} source={{uri: item.imagem}}/>
    {/* <Text style={styles.clientNome}>Linguagem</Text> */}
    <Text style={styles.clientNome}>{item.nome}</Text>
    <TouchableOpacity style={styles.clientButton} onPress={() => {this.props.navigation.navigate("Linguagem", {linguagem: item});}}>
      <Text style={styles.clientButtonText}>Detalhes</Text>
    </TouchableOpacity>
  </View>
);

render(){
    return(
      <View style={styles.container}>

      <View style={{flex:1}}>
          <TextInput style = {styles.input}
              placeholder = "EX: Linguagem PHP"
              placeholderTextColor = "#D3D3D3"
              autoCapitalize = "none"
              onChangeText = {this.handleSearch}/>
      </View>
      <View>
          <TouchableOpacity 
              style = {styles.submitButton} onPress = {() => {this.search(this.state.search);}}>
              <Text style = {styles.submitButtonText}> Pesquisar </Text>
          </TouchableOpacity>
      </View>

      <View style={{flex:8}}>
        <FlatList 
          contentContainerStyle={styles.list}
          data={this.state.linguagens}
          keyExtractor={item => item.id_linguagem_programacao.toString()}
          renderItem={this.renderItem}
        />
      </View>
       
        <View style={styles.footer}>
            <Text style={styles.textFooter}>© Copyright 2019-2022 MaiWeb.com.br. Todos os direitos reservados.</Text>
        </View>

      </View>
    );
  }
  
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#fafafa",
    paddingTop: 23
  },
  list: {
    paddingTop: 50,
    padding: 15,
  },
  input: {
      marginLeft: 15,
      marginRight: 15,
      padding: 5,
      height: 40,
    //borderColor: '#7a42f4',
      borderColor: '#DA552F',
      borderWidth: 1
  },
  submitButton: {
  //backgroundColor: '#7a42f4',
    backgroundColor: "transparent",
    alignItems: "center",
    paddingBottom: 8,
    paddingTop: 8,
    marginLeft: 45,
    marginRight: 45,
    marginTop: 5,
    height: 40,
    borderRadius: 5,
    borderWidth: 2,
    borderColor: "#DA552F",
  },
  submitButtonText:{
  //color: 'white',
    color: "#DA552F",
    fontWeight: "bold",
    fontSize: 16,
    textAlign: "center"
  },
  footer:{
    flex:1,
    backgroundColor:'#DA552F',
    
  },
  textFooter:{
    color: 'white',
    fontSize: 14,
    flexGrow:1,
    textAlign: 'center',
    top: 13
  },
  clientContainer:{
    height: 60,
    borderBottomWidth: 1,
    borderBottomColor: '#bbb',
    alignItems: 'center',
    flexDirection: 'row'
  },
  clientNome: {
    fontSize:20,
    paddingLeft: 20,
    flex: 7
  },
  clientButton: {
    height: 42,
    borderRadius: 5,
    borderWidth: 2,
    borderColor: "#DA552F",
    backgroundColor: "transparent",
    justifyContent: "center",
    alignItems: "center",
    marginTop: 10
  },
  clientButtonText: {
    fontSize: 16,
    color: "#DA552F",
    fontWeight: "bold"
  },
  avatar:{
    aspectRatio: 1,
    flex: 1,
    marginLeft: 10,
    borderRadius: 50
}

});















// render(){
//   return(
//     <View>
//       <Text>LISTA:</Text>
//       {this.state.linguagens.map(cliente => (
//            <Text key={cliente.id_cliente}>{cliente.nome}</Text>
//       ))}
//     </View>
//   );
// }

// componentDidMount(){
//   axios
//   .get('https://randomuser.me/api/?nat=br&results=5')
//   .then(response => {
//     const {results} = response.data
//     this.setState({
//       peoples: results[0].gender
//     })
//   })
// }