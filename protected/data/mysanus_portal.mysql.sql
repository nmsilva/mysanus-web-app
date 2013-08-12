drop DATABASE if exists mysanus_portal;
create database mysanus_portal;
use mysanus_portal;

/* Generated Script */

drop table if exists AGENDAS;

drop table if exists AGENDA_DISP;

drop table if exists AGREGADO;

drop table if exists CONSULTAS;

drop table if exists CONSUMIVEIS;

drop table if exists CONSUM_CONSULTA;

drop table if exists DEFINICOES;

drop table if exists DEF_USER;

drop table if exists DISPONIBILIDADE;

drop table if exists DOCUMENTOS;

drop table if exists ENTIDADES;

drop table if exists ENTIDADE_SERVICO;

drop table if exists EQUIPAMENTOS;

drop table if exists EQUIPAMENTO_ESPECIALIDADE;

drop table if exists EQUIPAMENTO_REQUESITO;

drop table if exists EQUI_CONSULTA;

drop table if exists ESPECIALIDADES;

drop table if exists FATURAS;

drop table if exists FORNECEDORES;

drop table if exists LOCAIS;

drop table if exists LOCAL_ENTIDADE;

drop table if exists MEDICAMENTOS;

drop table if exists MEDICAMENTO_CONSULTA;

drop table if exists MENSAGENS;

drop table if exists MSG_USER;

drop table if exists NOTIFICACOES;

drop table if exists NOTIF_USER;

drop table if exists PERGUNTAS;

drop table if exists PROFISSIONAIS;

drop table if exists PROF_CONSULTA;

drop table if exists PRO_ESPECIALIDADE;

drop table if exists QUESTIONARIOS;

drop table if exists REQUISITOS;

drop table if exists RESPONDE_QUEST;

drop table if exists RESPOSTAS;

drop table if exists SERVICOS;

drop table if exists SERVICOS_ADICIONAIS;

drop table if exists TIPOS_ENTIDADE;

drop table if exists TIPOS_ESPECIALIDADE;

drop table if exists TIPOS_PROFISSIONAL;

drop table if exists UTENTES;

drop table if exists UTENTE_ENTIDADE;

drop table if exists UTILIZADORES;

/*==============================================================*/
/* Table: AGENDAS                                               */
/*==============================================================*/
create table AGENDAS
(
   ID_AGEND             int not null auto_increment,
   ID_USER              int not null,
   DATA_CRIACAO         datetime not null,
   primary key (ID_AGEND)
);

/*==============================================================*/
/* Table: AGENDA_DISP                                           */
/*==============================================================*/
create table AGENDA_DISP
(
   ID_AGEND             int not null,
   ID_DISP              int not null,
   primary key (ID_AGEND, ID_DISP)
);

/*==============================================================*/
/* Table: AGREGADO                                              */
/*==============================================================*/
create table AGREGADO
(
   ID_USER              int not null,
   UTE_ID_USER          int not null,
   TIPO                 int,
   primary key (ID_USER, UTE_ID_USER)
);

/*==============================================================*/
/* Table: CONSULTAS                                             */
/*==============================================================*/
create table CONSULTAS
(
   ID_CON               int not null auto_increment,
   ID_ESP               int not null,
   ID_LOC               int not null,
   ID_FAC               int not null,
   ID_ENT               int not null,
   ID_USER              int not null,
   HORA                 datetime not null,
   ESTADO               bool not null default 0,
   OBSERVACOES          text,
   OBSERVACOES_MEDICAS  text,
   FORMA_PAGAMENTO      int not null,
   VALOR                decimal(8,2) not null,
   primary key (ID_CON)
);

/*==============================================================*/
/* Table: CONSUMIVEIS                                           */
/*==============================================================*/
create table CONSUMIVEIS
(
   ID_CONSU             int not null auto_increment,
   ID_FORN              int not null,
   NOME                 char(100) not null,
   primary key (ID_CONSU)
);

/*==============================================================*/
/* Table: CONSUM_CONSULTA                                       */
/*==============================================================*/
create table CONSUM_CONSULTA
(
   ID_CONSU             int not null,
   ID_CON               int not null,
   QUANTIDADE           int not null,
   primary key (ID_CONSU, ID_CON)
);

/*==============================================================*/
/* Table: DEFINICOES                                            */
/*==============================================================*/
create table DEFINICOES
(
   ID_DEF               int not null auto_increment,
   TAG                  char(100) not null,
   primary key (ID_DEF)
);

/*==============================================================*/
/* Table: DEF_USER                                              */
/*==============================================================*/
create table DEF_USER
(
   ID_DEF               int not null,
   ID_USER              int not null,
   VALUE                char(255) not null,
   primary key (ID_DEF, ID_USER)
);

/*==============================================================*/
/* Table: DISPONIBILIDADE                                       */
/*==============================================================*/
create table DISPONIBILIDADE
(
   ID_DISP              int not null auto_increment,
   DATA_INICIO          timestamp not null,
   DATA_FIM             timestamp not null,
   DESCRICAO            char(250),
   primary key (ID_DISP)
);

/*==============================================================*/
/* Table: DOCUMENTOS                                            */
/*==============================================================*/
create table DOCUMENTOS
(
   ID_DOC               int not null auto_increment,
   ID_CON               int,
   ID_USER              int not null,
   TIPO                 int,
   DATA_EMISSAO         datetime not null,
   ESTADO               bool not null default 0,
   NUMERO               char(50) not null default '1',
   IDENTIFICACAO        char(50) not null,
   primary key (ID_DOC)
);

/*==============================================================*/
/* Table: ENTIDADES                                             */
/*==============================================================*/
create table ENTIDADES
(
   ID_ENT               int not null auto_increment,
   ID_TIPO              int not null,
   NOME                 char(50) not null,
   SIGLA                char(12) not null,
   TELEFONE             char(9) not null,
   NIF                  char(12) not null,
   PORTA                char(50),
   _VALOR_C_            decimal(8,2) not null,
   VALOR_K              decimal(8,2) not null,
   VALOR_COLHEITA       decimal(8,2) not null,
   URB_TAXA_            decimal(8,2),
   NURB_TAXA            decimal(8,2),
   NURB_KM              decimal(8,2),
   CTT_TAXA             decimal(8,2),
   CIDADE               char(50),
   CODIGO_POSTAL        char(10),
   RUA                  char(50),
   LOCALIDADE           char(50),
   primary key (ID_ENT)
);

/*==============================================================*/
/* Table: ENTIDADE_SERVICO                                      */
/*==============================================================*/
create table ENTIDADE_SERVICO
(
   ID_ENT               int not null,
   ID_SERV              int not null,
   VALOR                decimal(8,2) not null,
   COD_SERVICO          char(12) not null,
   DESIG_SERVICO        text not null,
   TAXA                 char(20) not null,
   EUR_TAXA             bool not null,
   TAXA_URGENT          char(20),
   EUR_TAXA_URGENT      bool,
   primary key (ID_ENT, ID_SERV)
);

/*==============================================================*/
/* Table: EQUIPAMENTOS                                          */
/*==============================================================*/
create table EQUIPAMENTOS
(
   ID_EQUIP             int not null auto_increment,
   NOME                 char(50) not null,
   ESTADO               int,
   primary key (ID_EQUIP)
);

/*==============================================================*/
/* Table: EQUIPAMENTO_ESPECIALIDADE                             */
/*==============================================================*/
create table EQUIPAMENTO_ESPECIALIDADE
(
   ID_ESP               int not null,
   ID_EQUIP             int not null,
   primary key (ID_ESP, ID_EQUIP)
);

/*==============================================================*/
/* Table: EQUIPAMENTO_REQUESITO                                 */
/*==============================================================*/
create table EQUIPAMENTO_REQUESITO
(
   ID_EQUIP             int not null,
   ID_REQ               int not null,
   QUANT                int not null,
   primary key (ID_EQUIP, ID_REQ)
);

/*==============================================================*/
/* Table: EQUI_CONSULTA                                         */
/*==============================================================*/
create table EQUI_CONSULTA
(
   ID_EQUIP             int not null,
   ID_CON               int not null,
   primary key (ID_EQUIP, ID_CON)
);

/*==============================================================*/
/* Table: ESPECIALIDADES                                        */
/*==============================================================*/
create table ESPECIALIDADES
(
   ID_ESP               int not null auto_increment,
   ID_TIPO              int not null,
   NOME                 char(50) not null,
   primary key (ID_ESP)
);

/*==============================================================*/
/* Table: FATURAS                                               */
/*==============================================================*/
create table FATURAS
(
   ID_FAC               int not null auto_increment,
   ID_CON               int not null,
   MES                  int not null,
   DATA                 datetime not null,
   ANO                  int not null,
   SERIE                char(50) not null,
   ESTADO               bool not null default 0,
   DATA_ENVIO           datetime not null,
   NRECIBO              int not null default 1,
   primary key (ID_FAC)
);

/*==============================================================*/
/* Table: FORNECEDORES                                          */
/*==============================================================*/
create table FORNECEDORES
(
   ID_FORN              int not null auto_increment,
   IDENTIFICACAO        char(50) not null,
   NOME_CONTATO         char(50) not null,
   SITE                 char(50),
   EMAIL                char(50) not null,
   TELEFONE             char(9),
   TELEMOVEL            char(9) not null,
   OBSERVACOES          text,
   CIDADE               char(50),
   CODIGO_POSTAL        char(10),
   RUA                  char(50),
   LOCALIDADE           char(50),
   primary key (ID_FORN)
);

/*==============================================================*/
/* Table: LOCAIS                                                */
/*==============================================================*/
create table LOCAIS
(
   ID_LOC               int not null auto_increment,
   NOME                 char(50) not null,
   CIDADE               char(50),
   CODIGO_POSTAL        char(10),
   RUA                  char(50),
   LOCALIDADE           char(50),
   primary key (ID_LOC)
);

/*==============================================================*/
/* Table: LOCAL_ENTIDADE                                        */
/*==============================================================*/
create table LOCAL_ENTIDADE
(
   ID_LOC               int not null,
   ID_ENT               int not null,
   primary key (ID_LOC, ID_ENT)
);

/*==============================================================*/
/* Table: MEDICAMENTOS                                          */
/*==============================================================*/
create table MEDICAMENTOS
(
   ID_MED               int not null auto_increment,
   MED_ID               char(10) not null,
   primary key (ID_MED)
);

/*==============================================================*/
/* Table: MEDICAMENTO_CONSULTA                                  */
/*==============================================================*/
create table MEDICAMENTO_CONSULTA
(
   ID_MED               int not null,
   ID_CON               int not null,
   primary key (ID_MED, ID_CON)
);

/*==============================================================*/
/* Table: MENSAGENS                                             */
/*==============================================================*/
create table MENSAGENS
(
   ID_MSG               int not null auto_increment,
   ID_USER              int not null,
   CONTEUDO             text not null,
   DATA_ENVIO           datetime not null,
   ASSUNTO              char(255),
   ENVIADA              bool not null default 0,
   DATA_CRIACAO         datetime not null,
   APAGADA              bool not null default 0,
   primary key (ID_MSG)
);

/*==============================================================*/
/* Table: MSG_USER                                              */
/*==============================================================*/
create table MSG_USER
(
   ID_MSG               int not null,
   ID_USER              int not null,
   DATA_VISUALI         datetime not null,
   VISTA                bool not null default 0,
   APAGADA              bool not null default 0,
   primary key (ID_MSG, ID_USER)
);

/*==============================================================*/
/* Table: NOTIFICACOES                                          */
/*==============================================================*/
create table NOTIFICACOES
(
   ID_NOTF              int not null auto_increment,
   CONTEUDO             text not null,
   DATA_ENVIO           datetime not null,
   primary key (ID_NOTF)
);

/*==============================================================*/
/* Table: NOTIF_USER                                            */
/*==============================================================*/
create table NOTIF_USER
(
   ID_USER              int not null,
   ID_NOTF              int not null,
   DATA_VISUALI         datetime not null,
   VISTA                bool not null default 0,
   APAGADA              bool not null default 0,
   primary key (ID_USER, ID_NOTF)
);

/*==============================================================*/
/* Table: PERGUNTAS                                             */
/*==============================================================*/
create table PERGUNTAS
(
   ID_PERG              int not null auto_increment,
   ID_QUEST             int not null,
   PERGUNTA             text not null,
   primary key (ID_PERG)
);

/*==============================================================*/
/* Table: PROFISSIONAIS                                         */
/*==============================================================*/
create table PROFISSIONAIS
(
   ID_USER              int not null,
   ID_TIPO              int not null,
   FORMACAO             text,
   EXPERIENCIA_PROFISSIONAL text,
   AREAS_COMPETENCIA    text,
   PREMIOS              text,
   VALOR                decimal(8,2) not null,
   UNIDADE              char(25) not null,
   primary key (ID_USER)
);

/*==============================================================*/
/* Table: PROF_CONSULTA                                         */
/*==============================================================*/
create table PROF_CONSULTA
(
   ID_USER              int not null,
   ID_CON               int not null,
   primary key (ID_USER, ID_CON)
);

/*==============================================================*/
/* Table: PRO_ESPECIALIDADE                                     */
/*==============================================================*/
create table PRO_ESPECIALIDADE
(
   ID_ESP               int not null,
   ID_USER              int not null,
   primary key (ID_ESP, ID_USER)
);

/*==============================================================*/
/* Table: QUESTIONARIOS                                         */
/*==============================================================*/
create table QUESTIONARIOS
(
   ID_QUEST             int not null auto_increment,
   NOME                 char(50) not null,
   DATA_CRIACAO         datetime not null,
   primary key (ID_QUEST)
);

/*==============================================================*/
/* Table: REQUISITOS                                            */
/*==============================================================*/
create table REQUISITOS
(
   ID_REQ               int not null auto_increment,
   ID_ESP               int not null,
   NMEDICOS             int not null,
   NENFERMEIROS         int not null,
   NTECNICOS            int not null,
   primary key (ID_REQ)
);

/*==============================================================*/
/* Table: RESPONDE_QUEST                                        */
/*==============================================================*/
create table RESPONDE_QUEST
(
   ID_CON               int not null,
   ID_USER              int not null,
   ID_RESP              int not null,
   ID_PERG              int not null,
   primary key (ID_CON, ID_USER, ID_RESP, ID_PERG)
);

/*==============================================================*/
/* Table: RESPOSTAS                                             */
/*==============================================================*/
create table RESPOSTAS
(
   ID_RESP              int not null auto_increment,
   ID_PERG              int not null,
   RESPOSTA             text not null,
   TIPO                 char(50) not null,
   primary key (ID_RESP)
);

/*==============================================================*/
/* Table: SERVICOS                                              */
/*==============================================================*/
create table SERVICOS
(
   ID_SERV              int not null auto_increment,
   ID_ESP               int not null,
   NOME                 char(50) not null,
   primary key (ID_SERV)
);

/*==============================================================*/
/* Table: SERVICOS_ADICIONAIS                                   */
/*==============================================================*/
create table SERVICOS_ADICIONAIS
(
   ID_CON               int not null,
   ID_SERV              int not null,
   primary key (ID_CON, ID_SERV)
);

/*==============================================================*/
/* Table: TIPOS_ENTIDADE                                        */
/*==============================================================*/
create table TIPOS_ENTIDADE
(
   ID_TIPO              int not null auto_increment,
   NOME                 char(50) not null,
   primary key (ID_TIPO)
);

/*==============================================================*/
/* Table: TIPOS_ESPECIALIDADE                                   */
/*==============================================================*/
create table TIPOS_ESPECIALIDADE
(
   ID_TIPO              int not null auto_increment,
   DESCRICAO            char(50) not null,
   primary key (ID_TIPO)
);

/*==============================================================*/
/* Table: TIPOS_PROFISSIONAL                                    */
/*==============================================================*/
create table TIPOS_PROFISSIONAL
(
   ID_TIPO              int not null,
   DESCRICAO            char(150) not null,
   TAG                  char(150) not null,
   primary key (ID_TIPO)
);

/*==============================================================*/
/* Table: UTENTES                                               */
/*==============================================================*/
create table UTENTES
(
   ID_USER              int not null,
   SEXO                 char(20) not null,
   VALIDACAO            bool not null default 0,
   ESTADO_CIVIL         char(20),
   NCONTRIBUINTE        char(10) not null,
   NBENEFICIARIO        char(10) not null,
   NIF                  char(16) not null,
   TELEFONE_FIXO        char(9),
   TELEMOVEL2           char(9) not null,
   TELEMOVEL3           char(9),
   primary key (ID_USER)
);

/*==============================================================*/
/* Table: UTENTE_ENTIDADE                                       */
/*==============================================================*/
create table UTENTE_ENTIDADE
(
   ID_USER              int not null,
   ID_ENT               int not null,
   NBENEFECIARIO        char(12),
   DATA_VALIDADE        date,
   primary key (ID_USER, ID_ENT)
);

/*==============================================================*/
/* Table: UTILIZADORES                                          */
/*==============================================================*/
create table UTILIZADORES
(
   ID_USER              int not null auto_increment,
   NOME                 char(50) not null,
   EMAIL                char(100) not null,
   PASSWORD             char(255) not null,
   SALT                 char(100) not null,
   ESTADO               bool not null default 0,
   DATA_REGISTO         datetime not null,
   DATA_REVISAO         datetime,
   VERSAO               int not null default 1,
   ADMIN                bool not null default 0,
   FOTO                 char(100),
   DATA_NASC            date not null,
   BI                   char(10) not null,
   TELEMOVEL            char(9),
   CIDADE               char(50),
   CODIGO_POSTAL        char(10),
   RUA                  char(50),
   LOCALIDADE           char(50),
   primary key (ID_USER)
);

alter table AGENDAS add constraint FK_REGISTA foreign key (ID_USER)
      references PROFISSIONAIS (ID_USER) on delete restrict on update restrict;

alter table AGENDA_DISP add constraint FK_AGENDA_DISP foreign key (ID_AGEND)
      references AGENDAS (ID_AGEND) on delete restrict on update restrict;

alter table AGENDA_DISP add constraint FK_AGENDA_DISP2 foreign key (ID_DISP)
      references DISPONIBILIDADE (ID_DISP) on delete restrict on update restrict;

alter table AGREGADO add constraint FK_AGREGADO foreign key (ID_USER)
      references UTENTES (ID_USER) on delete restrict on update restrict;

alter table AGREGADO add constraint FK_AGREGADO2 foreign key (UTE_ID_USER)
      references UTENTES (ID_USER) on delete restrict on update restrict;

alter table CONSULTAS add constraint FK_APRESENTA foreign key (ID_ESP)
      references ESPECIALIDADES (ID_ESP) on delete restrict on update restrict;

alter table CONSULTAS add constraint FK_DEFINE foreign key (ID_ENT)
      references ENTIDADES (ID_ENT) on delete restrict on update restrict;

alter table CONSULTAS add constraint FK_EFECTUADA foreign key (ID_LOC)
      references LOCAIS (ID_LOC) on delete restrict on update restrict;

alter table CONSULTAS add constraint FK_EMITE2 foreign key (ID_FAC)
      references FATURAS (ID_FAC) on delete restrict on update restrict;

alter table CONSULTAS add constraint FK_MARCA foreign key (ID_USER)
      references UTENTES (ID_USER) on delete restrict on update restrict;

alter table CONSUMIVEIS add constraint FK_CONTEM_UM foreign key (ID_FORN)
      references FORNECEDORES (ID_FORN) on delete restrict on update restrict;

alter table CONSUM_CONSULTA add constraint FK_CONSUM_CONSULTA foreign key (ID_CONSU)
      references CONSUMIVEIS (ID_CONSU) on delete restrict on update restrict;

alter table CONSUM_CONSULTA add constraint FK_CONSUM_CONSULTA2 foreign key (ID_CON)
      references CONSULTAS (ID_CON) on delete restrict on update restrict;

alter table DEF_USER add constraint FK_DEF_USER foreign key (ID_DEF)
      references DEFINICOES (ID_DEF) on delete restrict on update restrict;

alter table DEF_USER add constraint FK_DEF_USER2 foreign key (ID_USER)
      references UTILIZADORES (ID_USER) on delete restrict on update restrict;

alter table DOCUMENTOS add constraint FK_GERA foreign key (ID_CON)
      references CONSULTAS (ID_CON) on delete restrict on update restrict;

alter table DOCUMENTOS add constraint FK_POSSUI foreign key (ID_USER)
      references UTENTES (ID_USER) on delete restrict on update restrict;

alter table ENTIDADES add constraint FK_TEM foreign key (ID_TIPO)
      references TIPOS_ENTIDADE (ID_TIPO) on delete restrict on update restrict;

alter table ENTIDADE_SERVICO add constraint FK_ENTIDADE_SERVICO foreign key (ID_ENT)
      references ENTIDADES (ID_ENT) on delete restrict on update restrict;

alter table ENTIDADE_SERVICO add constraint FK_ENTIDADE_SERVICO2 foreign key (ID_SERV)
      references SERVICOS (ID_SERV) on delete restrict on update restrict;

alter table EQUIPAMENTO_ESPECIALIDADE add constraint FK_EQUIPAMENTO_ESPECIALIDADE foreign key (ID_ESP)
      references ESPECIALIDADES (ID_ESP) on delete restrict on update restrict;

alter table EQUIPAMENTO_ESPECIALIDADE add constraint FK_EQUIPAMENTO_ESPECIALIDADE2 foreign key (ID_EQUIP)
      references EQUIPAMENTOS (ID_EQUIP) on delete restrict on update restrict;

alter table EQUIPAMENTO_REQUESITO add constraint FK_EQUIPAMENTO_REQUESITO foreign key (ID_EQUIP)
      references EQUIPAMENTOS (ID_EQUIP) on delete restrict on update restrict;

alter table EQUIPAMENTO_REQUESITO add constraint FK_EQUIPAMENTO_REQUESITO2 foreign key (ID_REQ)
      references REQUISITOS (ID_REQ) on delete restrict on update restrict;

alter table EQUI_CONSULTA add constraint FK_EQUI_CONSULTA foreign key (ID_EQUIP)
      references EQUIPAMENTOS (ID_EQUIP) on delete restrict on update restrict;

alter table EQUI_CONSULTA add constraint FK_EQUI_CONSULTA2 foreign key (ID_CON)
      references CONSULTAS (ID_CON) on delete restrict on update restrict;

alter table ESPECIALIDADES add constraint FK_TEM_TIPO foreign key (ID_TIPO)
      references TIPOS_ESPECIALIDADE (ID_TIPO) on delete restrict on update restrict;

alter table FATURAS add constraint FK_EMITE foreign key (ID_CON)
      references CONSULTAS (ID_CON) on delete restrict on update restrict;

alter table LOCAL_ENTIDADE add constraint FK_LOCAL_ENTIDADE foreign key (ID_LOC)
      references LOCAIS (ID_LOC) on delete restrict on update restrict;

alter table LOCAL_ENTIDADE add constraint FK_LOCAL_ENTIDADE2 foreign key (ID_ENT)
      references ENTIDADES (ID_ENT) on delete restrict on update restrict;

alter table MEDICAMENTO_CONSULTA add constraint FK_MEDICAMENTO_CONSULTA foreign key (ID_MED)
      references MEDICAMENTOS (ID_MED) on delete restrict on update restrict;

alter table MEDICAMENTO_CONSULTA add constraint FK_MEDICAMENTO_CONSULTA2 foreign key (ID_CON)
      references CONSULTAS (ID_CON) on delete restrict on update restrict;

alter table MENSAGENS add constraint FK_REMETENTE foreign key (ID_USER)
      references UTILIZADORES (ID_USER) on delete restrict on update restrict;

alter table MSG_USER add constraint FK_MSG_USER foreign key (ID_MSG)
      references MENSAGENS (ID_MSG) on delete restrict on update restrict;

alter table MSG_USER add constraint FK_MSG_USER2 foreign key (ID_USER)
      references UTILIZADORES (ID_USER) on delete restrict on update restrict;

alter table NOTIF_USER add constraint FK_NOTIF_USER foreign key (ID_USER)
      references UTILIZADORES (ID_USER) on delete restrict on update restrict;

alter table NOTIF_USER add constraint FK_NOTIF_USER2 foreign key (ID_NOTF)
      references NOTIFICACOES (ID_NOTF) on delete restrict on update restrict;

alter table PERGUNTAS add constraint FK_REPRESENTA foreign key (ID_QUEST)
      references QUESTIONARIOS (ID_QUEST) on delete restrict on update restrict;

alter table PROFISSIONAIS add constraint FK_REALIZA foreign key (ID_TIPO)
      references TIPOS_PROFISSIONAL (ID_TIPO) on delete restrict on update restrict;

alter table PROFISSIONAIS add constraint FK_UTILIZADORES2 foreign key (ID_USER)
      references UTILIZADORES (ID_USER) on delete restrict on update restrict;

alter table PROF_CONSULTA add constraint FK_PROF_CONSULTA foreign key (ID_USER)
      references PROFISSIONAIS (ID_USER) on delete restrict on update restrict;

alter table PROF_CONSULTA add constraint FK_PROF_CONSULTA2 foreign key (ID_CON)
      references CONSULTAS (ID_CON) on delete restrict on update restrict;

alter table PRO_ESPECIALIDADE add constraint FK_PRO_ESPECIALIDADE foreign key (ID_ESP)
      references ESPECIALIDADES (ID_ESP) on delete restrict on update restrict;

alter table PRO_ESPECIALIDADE add constraint FK_PRO_ESPECIALIDADE2 foreign key (ID_USER)
      references PROFISSIONAIS (ID_USER) on delete restrict on update restrict;

alter table REQUISITOS add constraint FK_PESQUISA foreign key (ID_ESP)
      references ESPECIALIDADES (ID_ESP) on delete restrict on update restrict;

alter table RESPONDE_QUEST add constraint FK_RESPONDE_QUEST foreign key (ID_CON)
      references CONSULTAS (ID_CON) on delete restrict on update restrict;

alter table RESPONDE_QUEST add constraint FK_RESPONDE_QUEST2 foreign key (ID_USER)
      references UTENTES (ID_USER) on delete restrict on update restrict;

alter table RESPONDE_QUEST add constraint FK_RESPONDE_QUEST3 foreign key (ID_RESP)
      references RESPOSTAS (ID_RESP) on delete restrict on update restrict;

alter table RESPONDE_QUEST add constraint FK_RESPONDE_QUEST4 foreign key (ID_PERG)
      references PERGUNTAS (ID_PERG) on delete restrict on update restrict;

alter table RESPOSTAS add constraint FK_CONTEM foreign key (ID_PERG)
      references PERGUNTAS (ID_PERG) on delete restrict on update restrict;

alter table SERVICOS add constraint FK_ENCONTRA_SE foreign key (ID_ESP)
      references ESPECIALIDADES (ID_ESP) on delete restrict on update restrict;

alter table SERVICOS_ADICIONAIS add constraint FK_SERVICOS_ADICIONAIS foreign key (ID_CON)
      references CONSULTAS (ID_CON) on delete restrict on update restrict;

alter table SERVICOS_ADICIONAIS add constraint FK_SERVICOS_ADICIONAIS2 foreign key (ID_SERV)
      references SERVICOS (ID_SERV) on delete restrict on update restrict;

alter table UTENTES add constraint FK_UTILIZADORES foreign key (ID_USER)
      references UTILIZADORES (ID_USER) on delete restrict on update restrict;

alter table UTENTE_ENTIDADE add constraint FK_UTENTE_ENTIDADE foreign key (ID_USER)
      references UTENTES (ID_USER) on delete restrict on update restrict;

alter table UTENTE_ENTIDADE add constraint FK_UTENTE_ENTIDADE2 foreign key (ID_ENT)
      references ENTIDADES (ID_ENT) on delete restrict on update restrict;

/*==============================================================*/
/* Insert Default Data                                   */
/*==============================================================*/

INSERT INTO `utilizadores` ( `NOME`, `EMAIL`, `PASSWORD`, `SALT`, `ESTADO`, `DATA_REGISTO`, `DATA_REVISAO`, `VERSAO`, `ADMIN`, `FOTO`, `DATA_NASC`, `BI`, `TELEMOVEL`, `CIDADE`, `CODIGO_POSTAL`, `RUA`, `LOCALIDADE`) VALUES
( 'Administração', 'geral@mysanus.pt', '8702dbb61999fa72abf8de8b383e4ed2176b688e0d84da8a20ef4fb3e4c4038b0d40b5ef479ff67b85efb2b8175733d563894d76b3716820f4c9d842f9ac9d73', 'ARkiZs9mOcmssTAEM135WGcN7wFllibY', 1, '2012-11-21 15:18:13', NULL, 1, 1, NULL, '0000-00-00', '', NULL, NULL, NULL, NULL, NULL);

INSERT INTO `tipos_profissional` (`ID_TIPO`, `DESCRICAO`,`TAG`) VALUES (1, 'Médico','medico'), (2, 'Enfermeiro','enfermeiro'),
(3, 'Técnico','tecnico');

INSERT INTO `tipos_especialidade` (`ID_TIPO`, `DESCRICAO`) VALUES (1, 'Medicina'), (2, 'Enfermagem'),
(3, 'Assistência Social'), (4, 'Farmácia'),(5, 'Fisioterapia'), (6, 'Medicina Veterinária'),
(7, 'Nutrição'), (8, 'Odontologia'),(9, 'Psicologia'), (10, 'Outros'), (11, 'Fonoaudiologia');

