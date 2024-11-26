from pysnmp.entity import engine, config
from pysnmp.hlapi import *
from pysnmp.carrier.asyncio.dgram import udp
from pysnmp.entity.rfc3413 import ntfrcv
from pprint import pprint
import subprocess
import os

snmpEngine = engine.SnmpEngine()
TrapAgentAddress='10.100.100.123'; #Trap listerner address
Port=162;  #trap listerner port

config.addTransport(
    snmpEngine,
    udp.DOMAIN_NAME + (1,),
    udp.UdpTransport().openServerMode((TrapAgentAddress, Port))
)

config.addV1System(snmpEngine, 'my-area', 'public')

def cbFun(snmpEngine, stateReference, contextEngineId, contextName,
          varBinds, cbCtx):
    execContext = snmpEngine.observer.getExecutionContext('rfc3412.receiveMessage:request')
    trap_host,trap_port=execContext['transportAddress']
    print("Received new Trap message from %s" % trap_host)
    p=trap_host+"||"
    for name, val in varBinds:   
        p+=name.prettyPrint()+"="
        p+=val.prettyPrint()+"|"
    pprint(p)   
    subprocess.call(['php', 'artisan','app:from-snmp',p])
ntfrcv.NotificationReceiver(snmpEngine, cbFun)

snmpEngine.transportDispatcher.jobStarted(1)

try:
    snmpEngine.transportDispatcher.runDispatcher()
except:
    snmpEngine.transportDispatcher.closeDispatcher()
    raise
