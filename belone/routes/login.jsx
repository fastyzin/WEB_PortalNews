import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
export var name

function Loginpage() {
  const [nome, setNome] = useState('');
  const [senha, setSenha] = useState('');
  const [error, setError] = useState('');
  const navigateTo = useNavigate();


  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post('http://localhost:8000/site/login/', {
        nome,
        senha,
      });
      const data = await response.data[0]
      if (response.status === 200) {
        name = data
        navigateTo('/view')
        console.log(name)
      }
    } catch (error) {
      setError('Usuário ou senha incorretos!')
    }
  };


  return (
    <div class="all">
      <h2>Login</h2>
      <form onSubmit={handleSubmit} method='POST'>
        <div>
          <label>Usuário:</label><br></br>
          <input
            type="text"
            value={nome}
            onChange={(nome) => setNome(nome.target.value)}
          />
        </div><br></br>
        <div>
          <label>Senha:</label><br></br>
          <input
            type="password"
            value={senha}
            onChange={(senha) => setSenha(senha.target.value)}
          />
        </div><br></br>
        <button type="submit">Logar</button><br></br>
        <p style={{color: 'red'}}>{error}</p>

        <button onClick={() => navigateTo('/cadastro')}>Cadastre-se</button>
      </form>
    </div>
  );
}

export default Loginpage;