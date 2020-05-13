import React from 'react';
import {WebView, View, Text, StyleSheet} from 'react-native';

// const Linguagem = () => <Text>Linguagem mais poderosa no mundo da programação.</Text>;
// const Linguagem = ({ navigation }) => {
//    console.log(navigation);
//    return(       
//    <WebView source={{uri:navigation.state.params.url}} />
//    )
// };

const Linguagem = ({ navigation }) => (
   //<WebView source={{uri:navigation.state.params.url}} />
   <View>
     <Text style={styles.discretion}>{navigation.state.params.linguagem.descricao}</Text>
   </View>
);

Linguagem.navigationOptions = ({ navigation }) => ({
    title: navigation.state.params.linguagem.nome,
    headerTitleStyle: {
      color: 'white',
      fontSize: 18,
      flexGrow:1,
      textAlign: 'left'
    }      
});

const styles = StyleSheet.create({
    discretion: {
       padding: 10,
       fontSize: 18
    }      
});



export default Linguagem;