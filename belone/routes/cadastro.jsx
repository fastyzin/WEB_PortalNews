import { useState } from 'react';
import { useNavigate, } from 'react-router-dom';
import axios from 'axios';

function Cadastropage() {
  const [nome, setNome] = useState('');
  const [senha, setSenha] = useState('');
  const [error, setError] = useState('');
  const navigateTo = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post('http://localhost:8000/site/user/', {
        nome,
        senha,
      });

      if (response.status === 201) {
        navigateTo('/')
      }
    } catch (error) {
      setError('Usuário ou senha incorretos!')
    }
  };


  return (
    <div>
      <h2>Cadastro</h2>
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
        <button type="submit">Cadastrar</button><br></br>
        <p style={{color: 'red'}}>{error}</p>
      </form>
    </div>
  );
}

export default Cadastropage;