import {createAppContainer} from 'react-navigation'
import { createStackNavigator } from 'react-navigation-stack'
import Main from './pages/main';
import Linguagem from './pages/linguagem';


const StackNavigator = createStackNavigator({
   Main,
   Linguagem
},{
   defaultNavigationOptions: {
     title: 'ᴹᵃᶤᵂᵉᵇ Linguagens de programação',
     headerStyle: {
       backgroundColor: '#DA552F',
       borderBottomWidth: 1,
       borderBottomColor: '#FFF'
     },
     headerTitleStyle: {
       color: 'white',
       fontSize: 18,
       flexGrow:1,
       textAlign: 'center'
     }
   }
});

const AppContainer = createAppContainer(StackNavigator);

export default AppContainer