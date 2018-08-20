@extends('templates.default')
@section('content')
    i am the home page
    @stop 



<!-- simulação do laço:

REPEAT
  	fetch cursor int Data_mensagem, Chat_id, Role_id, Perfil, User_id, Nome, Mensagem
    
    --regras aqui:
    		 
      
END REPEAT;	

-- situação 1 (o chat só contem aluno. não entra na função)

Data_mensagem 		   Chat_id  Role_id    Perfil   User_id         Nome                 Mensagem
2018-06-09 15:00:10		 999	   5		Aluno	   50	   Pedrinho					 preciso de ajuda.
2018-06-11 17:36:27		1000	   5		Aluno	  100	   Cristina Da Silva Leite	 Bom dia
2018-06-11 17:37:49		1000	   5	    Aluno	  100	   Cristina Da Silva Leite	 Alguem pode me ajudar?
2018-06-15 12:30:00		1001	   5		Aluno	  150	   Joaozinho				 olá...

-- situação 2 (o chat contem o aluno realizando a pergunta e o tutor logo responde)
-- Quando o registro atual for de Role_id 11 ou 13, pega Data_mensagem do registro anterior e 
   subtrai a Data_mensagem do registro atual somente se o registro anterior for de Role_id = 5
-- todas essas regras se aplicam somente para o mesmo Chat_id   

Data_mensagem 		   Chat_id  Role_id    Perfil   User_id         Nome                 Mensagem
2018-06-09 15:00:10		 999	   5		Aluno	   50	   Pedrinho					 preciso de ajuda.
2018-06-11 17:36:27		1000	   5		Aluno	  100	   Cristina Da Silva Leite	 Bom dia
2018-06-11 17:37:49		1000	   5	    Aluno	  100	   Cristina Da Silva Leite	 Alguem pode me ajudar?

2018-06-11 17:40:00		1000	   11	    Tutor	  200	   Tutor 1					 Bom dia, qual sua duvida?
2018-06-15 12:30:00		1001	   5		Aluno	  150	   Joaozinho				 olá...	


-- situação 3 (o chat contem o aluno realizando a pergunta e o tutor logo responde, mas outro tutor diferente responde também)
-- Quando o registro atual for de Role_id 11 ou 13, pega Data_mensagem do registro anterior e 
   subtrai a Data_mensagem do registro atual somente se o registro anterior for de Role_id = 5
-- segue a mesma regra, porém neste caso o registro antetior é tutor 11, entao o registro "anterior" deverá ser salvo
   em alguma variavel auxiliar só quando o Role_id = 5   
-- todas essas regras se aplicam somente para o mesmo Chat_id   

Data_mensagem 		   Chat_id  Role_id    Perfil   User_id         Nome                 Mensagem
2018-06-09 15:00:10		 999	   5		Aluno	   50	   Pedrinho					 preciso de ajuda.
2018-06-11 17:36:27		1000	   5		Aluno	  100	   Cristina Da Silva Leite	 Bom dia
2018-06-11 17:37:49		1000	   5	    Aluno	  100	   Cristina Da Silva Leite	 Alguem pode me ajudar?
2018-06-11 17:40:00		1000	   11	    Tutor	  200	   Tutor 1					 Bom dia, qual sua duvida?
2018-06-11 17:41:00		1000	   11	    Tutor	  220	   Tutor 2					 Olá posso ajudar?
2018-06-15 12:30:00		1001	   5		Aluno	  150	   Joaozinho				 olá...


-- situação 4 (o chat começa com tutor)
-- aqui deve percorrer os registros até achar um Role_id = 5 e após aplicar as regras da situação 1 e 2.  
-- todas essas regras se aplicam somente para o mesmo Chat_id

Data_mensagem 		   Chat_id  Role_id    Perfil   User_id         Nome                 Mensagem
2018-06-11 17:40:00		1000	   11	    Tutor	  200	   Tutor 1					 Bom dia pessoal.
2018-06-11 17:40:15		1000	   11	    Tutor	  200	   Tutor 1					 alguem com dúvidas?
2018-06-11 17:42:27		1000	   5		Aluno	  100	   Cristina Da Silva Leite	 Bom dia!
2018-06-11 17:42:49		1000	   5	    Aluno	  100	   Cristina Da Silva Leite	 tudo certo!!
2018-06-15 12:30:00		1001	   5		Aluno	  150	   Joaozinho				 olá -->






<!--  

--tabela temporaria
	DROP TEMPORARY TABLE IF EXISTS  `tb_temp_rel_chat`;
    CREATE TEMPORARY TABLE tb_temp_rel_chat
    (
     user_id bigint(20),
     name varchar(255),
     chat_id int(11),
     tempo_resposta timestamp
     );

--variaveis
		DECLARE user_id bigint(20);
		DECLARE nome, perfil varchar(255);
		DECLARE chat_id, role_id, id_message int(11);
		DECLARE tempo_resposta, dataenviomsg timestamp;
    DECLARE message text;
		DECLARE done INT DEFAULT 0;

--cursor e select
		DECLARE curs CURSOR FOR (
								select distinct 
								cm.created_at as dataenviomsg,
								cm.chat_id,
								r.id as role_id,
								r.display_name as perfil,
								u.id as user_id,
								u.name, 
								cm.id as id_message,
								cm.message
								from chat_messages cm
								inner join users u on u.id = cm.user_id 
								inner join roles r on r.id = u.role_id
								where  r.id in(5,11,13)
								and year(cm.created_at) = year(now()) 
								and (case when (month(cm.created_at) >= 6 and month(cm.created_at) <= 12) then 2 else 1 end) = (case when (month(now()) >= 6 and month(now()) <= 12) then 2 else 1 end) 
								order by cm.chat_id, cm.created_at
								);
	 
		DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;


-- simulação do laço:
OPEN curs;
REPEAT
  	FETCH curs INTO dataenviomsg, chat_id, role_id, perfil, user_id, nome, id_message, message;
					IF NOT done THEN
    --regras aqui:
    		 if (chat_id_ant = chat_id) then -- mesmo chat
							
                            if ((role_id = 11 or role_id = 13) and role_id_ant = 5) then -- se é tutor e role_id anterior é aluno
								
								set user_id_ant = user_id;
                                set tempo_resposta = timediff(dataenviomsg, dataenviomsg_ant);
                                --aqui vai inserir em uma tabela temporaria os dados do tutor role_id = 11 ou 13
                                --exemplo:
                                insert into tb_temp
                                values(user_id, nome,chat_id tempo_resposta);
                                
							end if;
                            
                         else
							
                         end if;
      END IF;
UNTIL done END REPEAT;

		CLOSE curs;
 -->
